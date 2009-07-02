<?php
/**
 * Plugin enter edit mode with double click
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Håkan Sandell <hakan.sandell@home.se>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC'))
    die();

if (!defined('DOKU_PLUGIN'))
    define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');

require_once (DOKU_PLUGIN . 'action.php');

class action_plugin_dblclickedit extends DokuWiki_Action_Plugin {

    /**
     * return some info
     */
    function getInfo() {
    return array (
            'author' => 'H&aring;kan Sandell',
            'email'  => 'hakan.sandell@home.se',
            'date'   => @file_get_contents(dirname(__FILE__).'/VERSION'),
            'name'   => 'DblClickEdit',
            'desc'   => 'Enter edit mode by double click',
            'url'    => 'http://www.dokuwiki.org/plugin:dblclickedit'
        );
    }

    /**
     * register the eventhandlers
     */
    function register(& $controller) {
        $controller->register_hook('TPL_CONTENT_DISPLAY', 'BEFORE', $this, 'handle_content_display');
    }

    function handle_content_display(& $event, $param) {
        global $ACT;
        if ($ACT!='show') return;

        $html = &$event->data;
        $html = preg_replace('/(\<(?:div class="level\d"|pre class="code[^"]*"|h\d))(\>)/', '$1 ondblclick="openSectionEdit(\'\')"$2', $html);
        return;
    }

}
