<?php

namespace Drupal\n1ed\Plugin\CKEditorPlugin;

use Drupal\n1ed\Plugin\N1EDEcosystemCKEditorPlugin;

/**
 * Defines plugin.
 *
 * @CKEditorPlugin(
 *   id = "N1EDEco",
 *   label = @Translation("N1ED"),
 *   module = "n1ed"
 * )
 */
class n1ed extends N1EDEcosystemCKEditorPlugin
{

    /**
     * {@inheritdoc}
     */
    public function getPluginName()
    {
        return "N1EDEco";
    }

    /**
     * {@inheritdoc}
     */
    public function getModuleName()
    {
        return "n1ed";
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonsDef()
    {
        return array(
            'HTML' => array(
                'label' => 'HTML source for N1ED',
                'image' => 'https://n1ed.com/cdn/buttons/HTMLSource.png'
            ),
            'Info' => array(
                'label' => 'Info',
                'image' => 'https://n1ed.com/cdn/buttons/Info.png'
            ),

            'AddImage' => array(
                'label' => 'Add image (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Image.png'
            ),
            'AddImagePreview' => array(
                'label' => 'Add image preview (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/ImagePreview.png'
            ),
            'AddImageGallery' => array(
                'label' => 'Add image gallery (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/ImageGallery.png'
            ),
            'AddFontAwesome' => array(
                'label' => 'Add Font Awesome icon (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/FontAwesome.png'
            ),
            'AddYouTube' => array(
                'label' => 'Add YouTube video (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/YouTube.png'
            ),
            'AddTable' => array(
                'label' => 'Add table (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Table.png'
            ),
            'AddLink' => array(
                'label' => 'Add link (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Link.png'
            ),
            'AddAnchor' => array(
                'label' => 'Add anchor (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Anchor.png'
            ),
            'AddHeader' => array(
                'label' => 'Add header (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/Header.png'
            ),
            'AddIFrame' => array(
                'label' => 'Add embedded page (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/IFrame.png'
            ),
            'AddHTML' => array(
                'label' => 'Add HTML snippet (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/HTML.png'
            ),
            'EditWidget' => array(
                'label' => 'Edit selected widget (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/HTML.png'
            ),
            'DeleteWidget' => array(
                'label' => 'Delete selecte widget (dialog UI mode only, use sidebar in other modes)',
                'image' => 'https://n1ed.com/cdn/buttons/DeleteWidget.png'
            )
        );
    }


    public function addControlsToForm(&$form, $editor, $config)
    {
    }

}
