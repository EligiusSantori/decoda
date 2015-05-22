<?php
/**
 * @copyright   2006-2014, Miles Johnson - http://milesj.me
 * @license     https://github.com/milesj/decoda/blob/master/license.md
 * @link        http://milesj.me/code/php/decoda
 */

namespace Decoda\Filter;

use Decoda\Decoda;

/**
 * Provides tags for ordered and unordered lists.
 */
class ListFilter extends AbstractFilter {

    const LIST_TYPE = '/^[-a-z]+$/i';

    /**
     * Supported tags.
     *
     * @type array
     */
    protected $_tags = array(
        'list' => array(
            'htmlTag' => 'ul',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'lineBreaks' => Decoda::NL_REMOVE,
            'childrenWhitelist' => array('*'),
            'onlyTags' => true,
        ),
        '*' => array(
            'htmlTag' => 'li',
            'displayType' => Decoda::TYPE_BLOCK,
            'allowedTypes' => Decoda::TYPE_BOTH,
            'childrenBlacklist' => array('list'),
            'parent' => array('list')
        )
    );

    public function listTag(array $tag, $content) {
        if(strpos($tag['text'], 'list=1') !== false)
            $tag['attributes']['style'] = 'list-style-type: decimal';
        return array($tag, $content);
    }
}