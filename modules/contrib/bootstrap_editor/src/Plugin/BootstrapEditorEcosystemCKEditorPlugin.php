<?php

namespace Drupal\bootstrap_editor\Plugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\ckeditor\CKEditorPluginContextualInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;

/**
 * Defines plugin.
 *
 * @CKEditorPlugin(
 *   id = "N1ED",
 *   label = @Translation("N1ED"),
 *   module = "n1ed"
 * )
 */

abstract class BootstrapEditorEcosystemCKEditorPlugin extends CKEditorPluginBase implements CKEditorPluginConfigurableInterface, CKEditorPluginContextualInterface
{

    /**
     * Returns plugin name.
     *
     * @return string
     *   Plugin name is a name of add-on in CKEditor terms
     */
    public abstract function getPluginName();

    /**
     * Returns module name.
     *
     * @return string
     *   Module name is a name of module in Drupal terms
     */
    public abstract function getModuleName();

    /**
     * Returns buttons list.
     *
     * @return array
     *   Associative array like in @CKEditorPlugin->getButtons
     */
    public abstract function getButtonsDef();

    /**
     * Adds controls to form using this class methods.
     */
    public abstract function addControlsToForm(&$form, $editor, $config);

    /**
     * {@inheritdoc}
     */
    public function getButtons()
    {
        return $this->getButtonsDef();
    }

    /**
     * {@inheritdoc}
     */
    public function getFile()
    {
        $apiKey = \Drupal::config('n1ed.settings')->get('apikey') ?: 'N1D8DFLT';
        return '//cloud.n1ed.com/cdn/'. $apiKey . '/latest/ckeditor/plugins/' . $this->getPluginName() . '/plugin.min.js';
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(Editor $editor)
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getLibraries(Editor $editor)
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function isInternal()
    {
        return FALSE;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled(Editor $editor)
    {
        return TRUE;
    }

    protected function getConfigParam($settings, $name, $default, $type)
    {
        if (isset($settings[$name]) && is_string($settings[$name]) && strlen($settings[$name]) > 0)
            $value = $settings[$name];
        else
            $value = $default;
        if (isset($type) && $type == 'number') {
            $value = intval($value);
        } else if (isset($type) && $type == 'boolean') {
            if ($value == 'true')
                $value = true;
            else if ($value == 'false')
                $value = false;
        } else if (isset($type) && $type == 'json') {
            if ($value != '')
                $value = json_decode($value);
        }

        $drupal8_specific_defaults = array(
            'urlFileManager' => '/flmngr',
            'urlFiles' => '/sites/default/files/flmngr',
            'dirUploads' => '/'
        );
        if (isset($drupal8_specific_defaults[$name]) && $value == '') {
            $value = $drupal8_specific_defaults[$name];
        }

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(Editor $editor)
    {
        $settings = array();
        if (isset($editor->getSettings()['plugins'][$this->getPluginName()]))
            $settings = $editor->getSettings()['plugins'][$this->getPluginName()];

        return $settings;
    }

    protected function addStringToForm(& $form, $settings, $param, $default)
    {
        $form[$param] = array(
            '#type' => 'textfield',
            '#title' => $param,
            '#title_display' => 'invisible',
            '#default_value' => $this->getConfigParam($settings, $param, $default, 'string'),
            '#attributes' => array(
                'style' => 'display: none!important',
                'data-n1ed-eco-param-name' => $param,
                'data-n1ed-eco-param-type' => 'string',
                'data-n1ed-eco-param-default' => $default
            )
        );
    }

    protected function addNumberToForm(& $form, $settings, $param, $default)
    {
        $form[$param] = array(
            '#type' => 'textfield',
            '#title' => $param,
            '#title_display' => 'invisible',
            '#default_value' => $this->getConfigParam($settings, $param, $default, 'number'),
            '#attributes' => array(
                'style' => 'display: none!important',
                'data-n1ed-eco-param-name' => $param,
                'data-n1ed-eco-param-type' => 'number',
                'data-n1ed-eco-param-default' => $default
            )
        );
    }

    protected function addBooleanToForm(& $form, $settings, $param, $default)
    {
        $form[$param] = array(
            '#type' => 'textfield',
            '#title' => $param,
            '#title_display' => 'invisible',
            '#default_value' => $this->getConfigParam($settings, $param, $default, 'boolean') ? "true" : "false",
            '#attributes' => array(
                'style' => 'display: none!important',
                'data-n1ed-eco-param-name' => $param,
                'data-n1ed-eco-param-type' => 'boolean',
                'data-n1ed-eco-param-default' => $default ? "true" : "false"
            )
        );
    }

    protected function addJsonToForm(& $form, $settings, $param, $default)
    {
        $form[$param] = array(
            '#type' => 'textarea',
            '#title' => $param,
            '#title_display' => 'invisible',
            '#default_value' => $this->getConfigParam($settings, $param, $default, 'string'),
            '#attributes' => array(
                'style' => 'display: none!important',
                'data-n1ed-eco-param-name' => $param,
                'data-n1ed-eco-param-type' => 'json',
                'data-n1ed-eco-param-default' => $default
            )
        );
    }

    protected function isLocallyInstalled()
    {
        return file_exists($_SERVER['DOCUMENT_ROOT'] . '/libraries/' . $this->getPluginName());
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor)
    {
        $config = $this->getConfig($editor);

        $form['info'] = [
            '#type' => 'html_tag',
            '#tag' => 'div',
            '#attributes' => [
                'data-n1ed-eco-plugin' => $this->getPluginName(),
                'data-plugin-installed' => $this->isLocallyInstalled() ? "true" : "false",
                'style' => 'display: inline-block;margin-top: 13px;margin-left: 10px;'
            ],
            '#value' => '<a href="#n1ed-conf">Configure ' . $this->getPluginName() . ' add-on</a>'
        ];

        $form['#attached']['library'][] = $this->getModuleName() . '/' . $this->getModuleName();
        $form['#attached']['drupalSettings']['n1edApiKey'] = \Drupal::config('n1ed.settings')->get('apikey') ?: 'N1D8DFLT';

        $this->addControlsToForm($form, $editor, $config);

        return $form;
    }

}
