<?php
// This file is part of Ranking block for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Moove block settings file
 *
 * @package    theme_advent
 * @copyright  2017 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingmoove', get_string('configtitle', 'theme_advent'));

    /*
    * ----------------------
    * General settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_advent_general', get_string('generalsettings', 'theme_advent'));

    // Logo file setting.
    $name = 'theme_advent/logo';
    $title = get_string('logo', 'theme_advent');
    $description = get_string('logodesc', 'theme_advent');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0, $opts);
    $page->add($setting);

    // Favicon setting.
    $name = 'theme_advent/favicon';
    $title = get_string('favicon', 'theme_advent');
    $description = get_string('favicondesc', 'theme_advent');
    $opts = array('accepted_types' => array('.ico'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0, $opts);
    $page->add($setting);

    // Preset.
    $name = 'theme_advent/preset';
    $title = get_string('preset', 'theme_advent');
    $description = get_string('preset_desc', 'theme_advent');
    $default = 'default.scss';

    $context = \core\context\system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_advent', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_advent/presetfiles';
    $title = get_string('presetfiles', 'theme_advent');
    $description = get_string('presetfiles_desc', 'theme_advent');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 10, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Login page background image.
    $name = 'theme_advent/loginbgimg';
    $title = get_string('loginbgimg', 'theme_advent');
    $description = get_string('loginbgimg_desc', 'theme_advent');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbgimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_advent/brandcolor';
    $title = get_string('brandcolor', 'theme_advent');
    $description = get_string('brandcolor_desc', 'theme_advent');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#0fad37');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-header-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_advent/secondarymenucolor';
    $title = get_string('secondarymenucolor', 'theme_advent');
    $description = get_string('secondarymenucolor_desc', 'theme_advent');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '#0fad37');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $fontsarr = [
        'Moodle' => 'Moodle Font',
        'Roboto' => 'Roboto',
        'Poppins' => 'Poppins',
        'Montserrat' => 'Montserrat',
        'Open Sans' => 'Open Sans',
        'Lato' => 'Lato',
        'Raleway' => 'Raleway',
        'Inter' => 'Inter',
        'Nunito' => 'Nunito',
        'Encode Sans' => 'Encode Sans',
        'Work Sans' => 'Work Sans',
        'Oxygen' => 'Oxygen',
        'Manrope' => 'Manrope',
        'Sora' => 'Sora',
        'Epilogue' => 'Epilogue'
    ];

    $name = 'theme_advent/fontsite';
    $title = get_string('fontsite', 'theme_advent');
    $description = get_string('fontsite_desc', 'theme_advent');
    $setting = new admin_setting_configselect($name, $title, $description, 'Roboto', $fontsarr);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_advent/enablecourseindex';
    $title = get_string('enablecourseindex', 'theme_advent');
    $description = get_string('enablecourseindex_desc', 'theme_advent');
    $default = 1;
    $choices = array(0 => get_string('no'), 1 => get_string('yes'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    /*
    * ----------------------
    * Advanced settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_advent_advanced', get_string('advancedsettings', 'theme_advent'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_advent/scsspre',
        get_string('rawscsspre', 'theme_advent'), get_string('rawscsspre_desc', 'theme_advent'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_advent/scss', get_string('rawscss', 'theme_advent'),
        get_string('rawscss_desc', 'theme_advent'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Google analytics block.
    $name = 'theme_advent/googleanalytics';
    $title = get_string('googleanalytics', 'theme_advent');
    $description = get_string('googleanalyticsdesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    /*
    * -----------------------
    * Frontpage settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_advent_frontpage', get_string('frontpagesettings', 'theme_advent'));

    // Disable teachers from cards.
    $name = 'theme_advent/disableteacherspic';
    $title = get_string('disableteacherspic', 'theme_advent');
    $description = get_string('disableteacherspicdesc', 'theme_advent');
    $default = 1;
    $choices = array(0 => get_string('no'), 1 => get_string('yes'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Slideshow.
    $name = 'theme_advent/slidercount';
    $title = get_string('slidercount', 'theme_advent');
    $description = get_string('slidercountdesc', 'theme_advent');
    $default = 0;
    $options = array();
    for ($i = 0; $i < 13; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $slidercount = get_config('theme_advent', 'slidercount');

    if (!$slidercount) {
        $slidercount = $default;
    }

    if ($slidercount) {
        for ($sliderindex = 1; $sliderindex <= $slidercount; $sliderindex++) {
            $fileid = 'sliderimage' . $sliderindex;
            $name = 'theme_advent/sliderimage' . $sliderindex;
            $title = get_string('sliderimage', 'theme_advent');
            $description = get_string('sliderimagedesc', 'theme_advent');
            $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
            $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
            $page->add($setting);

            $name = 'theme_advent/slidertitle' . $sliderindex;
            $title = get_string('slidertitle', 'theme_advent');
            $description = get_string('slidertitledesc', 'theme_advent');
            $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
            $page->add($setting);

            $name = 'theme_advent/slidercap' . $sliderindex;
            $title = get_string('slidercaption', 'theme_advent');
            $description = get_string('slidercaptiondesc', 'theme_advent');
            $default = '';
            $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
            $page->add($setting);
        }
    }

    $setting = new admin_setting_heading('slidercountseparator', '', '<hr>');
    $page->add($setting);

    $name = 'theme_advent/displaymarketingbox';
    $title = get_string('displaymarketingboxes', 'theme_advent');
    $description = get_string('displaymarketingboxesdesc', 'theme_advent');
    $default = 1;
    $choices = array(0 => get_string('no'), 1 => get_string('yes'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    $displaymarketingbox = get_config('theme_advent', 'displaymarketingbox');

    if ($displaymarketingbox) {
        // Marketingheading.
        $name = 'theme_advent/marketingheading';
        $title = get_string('marketingsectionheading', 'theme_advent');
        $default = 'Awesome App Features';
        $setting = new admin_setting_configtext($name, $title, '', $default);
        $page->add($setting);

        // Marketingcontent.
        $name = 'theme_advent/marketingcontent';
        $title = get_string('marketingsectioncontent', 'theme_advent');
        $default = 'Moove is a Moodle template based on Boost with modern and creative design.';
        $setting = new admin_setting_confightmleditor($name, $title, '', $default);
        $page->add($setting);

        for ($i = 1; $i < 5; $i++) {
            $filearea = "marketing{$i}icon";
            $name = "theme_advent/$filearea";
            $title = get_string('marketingicon', 'theme_advent', $i . '');
            $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
            $setting = new admin_setting_configstoredfile($name, $title, '', $filearea, 0, $opts);
            $page->add($setting);

            $name = "theme_advent/marketing{$i}heading";
            $title = get_string('marketingheading', 'theme_advent', $i . '');
            $default = 'Lorem';
            $setting = new admin_setting_configtext($name, $title, '', $default);
            $page->add($setting);

            $name = "theme_advent/marketing{$i}content";
            $title = get_string('marketingcontent', 'theme_advent', $i . '');
            $default = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.';
            $setting = new admin_setting_confightmleditor($name, $title, '', $default);
            $page->add($setting);
        }

        $setting = new admin_setting_heading('displaymarketingboxseparator', '', '<hr>');
        $page->add($setting);
    }

    // Enable or disable Numbers sections settings.
    $name = 'theme_advent/numbersfrontpage';
    $title = get_string('numbersfrontpage', 'theme_advent');
    $description = get_string('numbersfrontpagedesc', 'theme_advent');
    $default = 1;
    $choices = array(0 => get_string('no'), 1 => get_string('yes'));
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    $numbersfrontpage = get_config('theme_advent', 'numbersfrontpage');

    if ($numbersfrontpage) {
        $name = 'theme_advent/numbersfrontpagecontent';
        $title = get_string('numbersfrontpagecontent', 'theme_advent');
        $description = get_string('numbersfrontpagecontentdesc', 'theme_advent');
        $default = get_string('numbersfrontpagecontentdefault', 'theme_advent');
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);
    }

    // Enable FAQ.
    $name = 'theme_advent/faqcount';
    $title = get_string('faqcount', 'theme_advent');
    $description = get_string('faqcountdesc', 'theme_advent');
    $default = 0;
    $options = array();
    for ($i = 0; $i < 11; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $page->add($setting);

    $faqcount = get_config('theme_advent', 'faqcount');

    if ($faqcount > 0) {
        for ($i = 1; $i <= $faqcount; $i++) {
            $name = "theme_advent/faqquestion{$i}";
            $title = get_string('faqquestion', 'theme_advent', $i . '');
            $setting = new admin_setting_configtext($name, $title, '', '');
            $page->add($setting);

            $name = "theme_advent/faqanswer{$i}";
            $title = get_string('faqanswer', 'theme_advent', $i . '');
            $setting = new admin_setting_confightmleditor($name, $title, '', '');
            $page->add($setting);
        }

        $setting = new admin_setting_heading('faqseparator', '', '<hr>');
        $page->add($setting);
    }

    $settings->add($page);

    /*
    * --------------------
    * Footer settings tab
    * --------------------
    */
    $page = new admin_settingpage('theme_advent_footer', get_string('footersettings', 'theme_advent'));

    // Website.
    $name = 'theme_advent/website';
    $title = get_string('website', 'theme_advent');
    $description = get_string('websitedesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Mobile.
    $name = 'theme_advent/mobile';
    $title = get_string('mobile', 'theme_advent');
    $description = get_string('mobiledesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Mail.
    $name = 'theme_advent/mail';
    $title = get_string('mail', 'theme_advent');
    $description = get_string('maildesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Facebook url setting.
    $name = 'theme_advent/facebook';
    $title = get_string('facebook', 'theme_advent');
    $description = get_string('facebookdesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Twitter url setting.
    $name = 'theme_advent/twitter';
    $title = get_string('twitter', 'theme_advent');
    $description = get_string('twitterdesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Linkdin url setting.
    $name = 'theme_advent/linkedin';
    $title = get_string('linkedin', 'theme_advent');
    $description = get_string('linkedindesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Youtube url setting.
    $name = 'theme_advent/youtube';
    $title = get_string('youtube', 'theme_advent');
    $description = get_string('youtubedesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Instagram url setting.
    $name = 'theme_advent/instagram';
    $title = get_string('instagram', 'theme_advent');
    $description = get_string('instagramdesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Whatsapp url setting.
    $name = 'theme_advent/whatsapp';
    $title = get_string('whatsapp', 'theme_advent');
    $description = get_string('whatsappdesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    // Telegram url setting.
    $name = 'theme_advent/telegram';
    $title = get_string('telegram', 'theme_advent');
    $description = get_string('telegramdesc', 'theme_advent');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $page->add($setting);

    $settings->add($page);
}
