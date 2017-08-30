<?php
require_once "/u01/htdocs/sixcms8/sixcms_public/sixcms_config_user.php";
require_once "{$prefs['sixcms_path_fs']}/api/php/CMSAPI.php";

$out = array();

$options = array
(
    'readonly' => 'online',
    'return' => 'all'
);

$in = array
(
  'area_id' => 3286,
  'max' => 1,
);

$error = CMSAPI::RecordGet($in, $out, $options);

$out = reset($out);
$dev = array_keys($out);
echo serialize($dev);

// Output from liveserver into string here!
$live = 'a:55:{i:0;s:2:"id";i:1;s:4:"gsid";i:2;s:4:"lsid";i:3;s:5:"extid";i:4;s:5:"title";i:5;s:7:"area_id";i:6;s:13:"creation_date";i:7;s:11:"change_date";i:8;s:11:"online_date";i:9;s:12:"offline_date";i:10;s:13:"deadline_date";i:11;s:6:"status";i:12;s:9:"published";i:13;s:8:"workcopy";i:14;s:11:"user_change";i:15;s:8:"group_id";i:16;s:11:"template_id";i:17;s:7:"deleted";i:18;s:12:"language_iso";i:19;s:12:"change_sysid";i:20;s:12:"change_stamp";i:21;s:7:"env_key";i:22;s:9:"area_gsid";i:23;s:4:"user";i:24;s:14:"conversion_tag";i:25;s:15:"flag_ausgebucht";i:26;s:12:"flag_inhouse";i:27;s:11:"flag_rabatt";i:28;s:18:"flag_veranstaltung";i:29;s:12:"flag_webinar";i:30;s:9:"form_type";i:31;s:7:"gg_flag";i:32;s:5:"image";i:33;s:9:"image_box";i:34;s:12:"image_teaser";i:35;s:6:"nutzen";i:36;s:11:"nutzen_html";i:37;s:7:"or_flag";i:38;s:4:"path";i:39;s:8:"programm";i:40;s:13:"programm_html";i:41;s:14:"recipent_email";i:42;s:6:"teaser";i:43;s:4:"text";i:44;s:8:"text_box";i:45;s:13:"text_box_html";i:46;s:9:"text_html";i:47;s:6:"themen";i:48;s:11:"themen_html";i:49;s:17:"veranstaltungsort";i:50;s:7:"vr_flag";i:51;s:10:"zielgruppe";i:52;s:15:"zielgruppe_html";i:53;s:29:"rel_veranstaltung_termine_tlp";i:54;s:19:"vr_event_boxen_oben";}';
$live = unserialize($live);

echo "<pre>";
var_dump(array_diff($dev, $live));
var_dump(array_diff($live, $dev));
echo "</pre>";
