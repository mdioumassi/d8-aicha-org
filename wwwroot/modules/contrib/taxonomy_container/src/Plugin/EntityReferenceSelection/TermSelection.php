<?php

namespace Drupal\taxonomy_container\Plugin\EntityReferenceSelection;

use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Plugin\EntityReferenceSelection\TermSelection as BaseTermSelection;

/**
 * Taxonomy container implementation of the entity reference selection plugin.
 *
 * @EntityReferenceSelection(
 *   id = "taxonomy_container",
 *   label = @Translation("Taxonomy term selection (with groups)"),
 *   entity_types = {"taxonomy_term"},
 *   group = "taxonomy_container"
 * )
 */
class TermSelection extends BaseTermSelection {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['prefix' => '-'] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['auto_create']['#access'] = FALSE;
    $form['auto_create_bundle']['#access'] = FALSE;

    $form['prefix'] = [
      '#title' => $this->t('List item prefix'),
      '#type' => 'textfield',
      '#size' => 5,
      '#maxlength' => 5,
      '#description' => $this->t('The character before each child term.'),
      '#default_value' => $this->configuration['prefix'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   *
   * That actually violates parent interface. The method should return entity
   * labels not grouped options for a select list. Technically core selection
   * plugin also does this in a wrong way because it puts dashed in front of
   * entity labels. The proper solution could be creating a field widget for
   * entity_reference field. However that would be not possible to register it
   * only for a specific entity type (Taxonomy Term).
   *
   * @see \Drupal\Core\Entity\EntityReferenceSelection\SelectionInterface::getReferenceableEntities()
   */
  public function getReferenceableEntities($match = NULL, $match_operator = 'CONTAINS', $limit = 0) {

    if ($match || $limit) {
      return parent::getReferenceableEntities($match, $match_operator, $limit);
    }

    $bundles = $this->entityTypeBundleInfo->getBundleInfo('taxonomy_term');
    $bundle_names = $this->getConfiguration()['target_bundles'] ?: array_keys($bundles);

    /** @var \Drupal\taxonomy\TermStorageInterface $term_storage */
    $term_storage = $this->entityTypeManager->getStorage('taxonomy_term');

    $prefix = $this->configuration['prefix'];

    $options = [];
    foreach ($bundle_names as $bundle) {

      // Use first bundle as key. This prevents turning bundle labels into
      // optgroups when more than one bundle were provided.
      // See \Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem::getSettableOptions().
      // phpcs:ignore DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
      if (!isset($key)) {
        $key = $bundle;
      }

      /** @var \Drupal\taxonomy\TermInterface[] $terms */
      $terms = $term_storage->loadTree($bundle, 0, NULL, TRUE);
      $protected_terms = [];

      /** @var string $parent_id */
      /** @var string $parent_label */
      foreach ($terms as $term) {
        $access = TRUE;

        if (!$term->access('view') || in_array($term->parent->target_id, $protected_terms)) {
          $protected_terms[] = $term->id();
          $access = FALSE;
        }

        // Check if this is a parent item. We do a loose comparison on the
        // string value of zero ('0') so that the result is correct both for
        // numeric and string IDs. If we would compare to the numeric value of
        // zero (0) PHP would cast both arguments to numbers. In the case of
        // string IDs the ID would always be casted to a 0 causing the
        // condition to always be TRUE.
        if ($term->parent->target_id == '0') {
          $parent_id = $term->id();
          $parent_label = Html::escape($this->entityRepository->getTranslationFromContext($term)->label());
          if ($access) {
            $options[$key][$term->id()] = $parent_label;
          }
        }
        else {
          if ($access) {
            $label = Html::escape($this->entityRepository->getTranslationFromContext($term)->label());
            $options[$key][$parent_label][$term->id()] = str_repeat($prefix, $term->depth) . $label;
          }
          // If at least on child has been found, remove the top level term.
          unset($options[$key][$parent_id]);
        }
      }

    }

    return $options;
  }

}
