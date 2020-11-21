<?php

/**
 * @file
 * Contains \Drupal\n1ed\Form\N1EDConfigForm.
 */

namespace Drupal\n1ed\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class N1EDConfigForm extends ConfigFormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'n1ed_config_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $config = $this->config('n1ed.settings');
        $form['apikey'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('API key'),
            '#default_value' => $config->get('apikey') ?: 'N1D8DFLT',
            '#required' => TRUE,
        );
        $form['text'] = array(
            '#type' => 'html_tag',
            '#tag' => 'p',
            '#attributes' => [
                'style' => 'margin-bottom:12px;margin-top: -4px;'
            ],
            '#value' => 'You can <a href="https://n1ed.com/dashboard" target="_blank">get your API key</a> for free.'
        );
        return parent::buildForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $values = $form_state->getValues();

        $config = $this->config('n1ed.settings');
        $config->set('apikey', $values['apikey'])->save();

        parent::submitForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */

    protected function getEditableConfigNames() {
        return ['n1ed.settings'];
    }

}