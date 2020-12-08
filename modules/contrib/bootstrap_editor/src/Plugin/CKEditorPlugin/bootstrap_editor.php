<?php

namespace Drupal\bootstrap_editor\Plugin\CKEditorPlugin;

use Drupal\bootstrap_editor\Plugin\BootstrapEditorEcosystemCKEditorPlugin;
use Drupal\editor\Entity\Editor;

/**
 * Defines plugin.
 *
 * @CKEditorPlugin(
 *   id = "BootstrapEditor",
 *   label = @Translation("BootstrapEditor"),
 *   module = "bootstrap_editor"
 * )
 */
class bootstrap_editor extends BootstrapEditorEcosystemCKEditorPlugin
{

    /**
     * {@inheritdoc}
     */
    public function getPluginName()
    {
        return "BootstrapEditor";
    }

    /**
     * {@inheritdoc}
     */
    public function getModuleName()
    {
        return "bootstrap_editor";
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonsDef()
    {
        return array(
            'AddButton' => array(
                'label' => 'Add button (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Button.png'
            ),
            'AddTabs' => array(
                'label' => 'Add tabs (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Tabs.png'
            ),
            'AddAccordion' => array(
                'label' => 'Add accordion (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Accordion.png'
            ),
            'AddBadge' => array(
                'label' => 'Add badge (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Badge.png'
            ),
            'AddAlert' => array(
                'label' => 'Add alert message (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Alert.png'
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(Editor $editor)
    {
        return array(
            "N1ED"
        );
    }

    public function addControlsToForm(&$form, $editor, $config)
    {
        $this->addBooleanToForm($form, $config, "enableBootstrapEditor", true);
        $this->addJsonToForm($form, $config, "bootstrap4", "");
    }
}
