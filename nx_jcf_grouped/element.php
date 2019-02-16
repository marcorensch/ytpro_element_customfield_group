<?php

return [

    // Define transforms for the element node
    'transforms' => [

        // The function is executed before the template is rendered
        'render' => function ($node, array $params) {

            // Joomla! Fields Helper & Setup to get the Fields for this article:
            JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
            $model = JModelLegacy::getInstance('Article', 'ContentModel', array('ignore_request'=>true));
            $articleID = JFactory::getApplication()->input->get('id');
            $appParams = JFactory::getApplication()->getParams();
            $model->setState('params', $appParams);
            $item = $model->getItem($articleID);

            // get the Articles's Customfields
            $jcFields = FieldsHelper::getFields('com_content.article', $item, true);
            $itemCustomFields = array();
            foreach($jcFields as $field) {
                $itemCustomFields[$field->name]['value'] = $field->rawvalue;
                $itemCustomFields[$field->name]['label'] = $field->label;
            };

            // Element object (stdClass)
            $node->type; // Type name (string)
            $node->props; // Field properties (array)
            $node->children; // All children (array)

            $node->cfields = $itemCustomFields;

            // Parameter array
            $params['path']; // All parent elements (array)
            $params['parent']; // Parent element (stdClass)
            $params['builder']; // Builder instance (YOOtheme\Builder)
            $params['type']; // Element definition (YOOtheme\Builder\ElementType)
            $params['app']; // Application instance (YOOtheme\Application)

        },

    ],

    // Define updates for the element node
    'updates' => [

        '1.18.0' => function ($node, array $params) {

            // Remove or modify deprecated properties
            unset($node->props['deprecated_prop']);

        },

    ],

];
