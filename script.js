/**
 * DblClickEdit Plugin - enter edit mode with double click
 *
 * @license  GPL2 (http://www.gnu.org/licenses/gpl.html)
 * @author   Håkan Sandell <sandell.hakan@gmail.com>
 */

jQuery(function () {

    if (JSINFO.dblclick == 2) {
        /**
         *  Register double click event for all headings (h*.sectionedit)
         *  and sections (div.level*) following a sectionedit header
         *  Beware of div.levels before the first edit section
         */
        jQuery('[class*="sectionedit"], [class*="sectionedit"] ~ div[class^="level"]').dblclick(function(e){

            /**
             * Find the closest edit button form to the element double clicked (downwards) and submit the form
             * look for div.secedit to support custom section editors like plugin:edittable and plugin:data
             * stop event propagation to allow for full page edit
             */
            jQuery(this).nextAll('.secedit:eq(0)').children('form:eq(0)').submit();
            e.stopPropagation();
        });
    } 

    /**
     *  Find page content div and attach default page edit handler
     *  templates supported
     *      starter based:      div.page                a.action.edit
     *      old default:        div.page                form.btn_edit
     *      monobook/vector:    div#bodyContent         #ca-edit > a
     *      sidebar:            div.page_with_sidebar   form.btn_edit
     *      arctic:             div.right_page          a.action.edit
     */
    if (JSINFO.dblclick) {
        $pageDiv = jQuery('div.page, div.page_with_sidebar, div.right_page, div#bodyContent');
        $editLink = jQuery('a.action.edit, #ca-edit > a');
        $editBtn = jQuery('form.btn_edit');

        if ($pageDiv[0]) {
            $pageDiv.dblclick(function() {
                if ($editBtn[0]) {
                    $editBtn[0].submit();
                } else {
                    window.location = $editLink.attr('href');
                }
            });
        }
    
    } 
});

