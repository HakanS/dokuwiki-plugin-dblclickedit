<?php
/**
 * DblClickEdit Plugin - enter edit mode with double click
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Håkan Sandell <hakan.sandell@home.se>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class action_plugin_dblclickedit extends DokuWiki_Action_Plugin {

    /**
     * register the eventhandlers
     */
    function register(Doku_Event_Handler $controller) {
        $controller->register_hook('DOKUWIKI_STARTED', 'AFTER',  $this, 'enable_dblClick', array());
    }

    /**
     *  Ensure we have enough access rights and edit is an allowed action
     *  section edit is disabled for old revisions
     */
    function enable_dblClick(& $event, $param) {
        global $INFO;
        global $ACT;
        global $REV;
        global $JSINFO;

        if ($INFO['writable'] && in_array($ACT, array('show'))) {
            if ($REV > 0) {
                $JSINFO['dblclick'] = 1;
            } else {
                $JSINFO['dblclick'] = 2;
            }
        }
    }

}
