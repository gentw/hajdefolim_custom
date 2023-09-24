(function ($) {
  "use strict";
  /*jslint plusplus: true */
  /*jslint browser: true*/
  /*jslint newcap: true */
  /*global $, jQuery, alert, Audio, case, wptpa_data*/
  /*jslint evil: true */
  /*global console */
  /*global Snap */
  /*global mina */
  $.fn.tPlayer = function (options) {
    // Дефолтные настройки
    var defaults = {
      playlist: '',
      autoplay: true,
      showPlaylist: true,
      shuffle: true,
      share: true,
      twitterText: '',
      compactMode: false,
      defaultVolume: 0.75,
      promo: '',
      promoMode: false,
      promoTime: 60000,
      songlimit: 0,
      playerBG: "#fff",
      playerTextCLR: "#555",
      buttonCLR: "#555",
      buttonActiveCLR: "#3EC3D5",
      seekBarCLR: "#555",
      progressBarCLR: "#3EC3D5",
      timeCLR: "#fff",
      playlistBG: "#3EC3D5",
      playlistTextCLR: "#fff",
      playlistCurBG: "#fd4145",
      playlistTextCurCLR: "#fff"
    },
      settings = $.extend(defaults, options), // обьеденяем деволтные настройки с пользовательскими настройками
      $tPlayer = $(this), // Обьявляем главный контейнер
      playlist = JSON.parse(JSON.stringify(settings.playlist)),// Превращаем обьект в JSON, а джосн строку в массив
      // обьявляем переменные для контейнеров
      $player, $cover_viewer, $cover_wrapper, $cover, $heading, $marquee, $playback, $audio, $seek, $progress, $current,
      $duration, $previous, $repeat, $next, $shuffle, $share, $playlist_toggle, $mute, $volume_range,
      $volume, $volumeValue, $playlist, $playlistItem,  $wptpa_playlist_item, $wptpa_playlist_scroll, $wptpa_playlist_scroll_handle, $wptpa_dwn, $fb, $twitter, $gp, $tmblr, $modal, $overlay, $info_wrapper,
      $info_heading, $info_container, $promo, promoInterval, coverside, open_nw, playbackIcn, seekHandleIcn,
      nextIcn, repeatIcn, prevIcn, shuffleIcnP, shuffleIcnAT, shuffleIcnAB, shareIcnP, shareIcnCT, shareIcnCM, shareIcnCB,
      playlist_toggleIcn, muteIcn, mutedIcn, muteIcnL, muteIcnM, muteIcnR, playIcon, $wptpa_cover_loader, $info_area, all_count, all_dwn,
      
      songlimit = settings.songlimit, // получаем лимит плейлиста
      
      // обьявляем переменные и флаги
      currentSong, // Текущий трек
      currentSlide, // Текущий слайд
      countSongs, // кол-во треков
      playlistOrder = '', //скопировать порядок песен для возврата с шафла
      coverOrder = '', //скопировать порядок обложек для возврата с шафла
      repeatMode = false,
      shuffleMode = false,
      seeksliding = false,
      mutedAnim = false,
      adsMode = false,
      volume = settings.defaultVolume, // громкость
      showPlaylist = settings.showPlaylist, // показывать ли плейлист
      $code = '',
      i = 0, title, tips,
      countCover = 0,
      style = '',
      id = $tPlayer.attr("id"); // кол-во каверов для проверки их загружености
    
    style = '<style>';
    // добавляем скрол если установлен
    if (settings.songlimit > 0) {
      style += '#' + id + ' .wptpa_playlist_wrapper { max-height:' + (settings.songlimit * 40) + 'px; }';
    }

    style += "#" + id + " .wptpa_social_share,";
    style += "#" + id + " .wptpa_player {";
    style += "background: " + settings.playerBG + ";";
    style += "}";
    style += "#" + id + " .wptpa_cover_viewer {";
    style += "background: " + settings.seekBarCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_circular_path{";
    style += "stroke: " + settings.progressBarCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_cover_viewer:before {";
    style += "background: " + settings.playerBG + ";";
    style += "}";
    style += "#" + id + " .wptpa_cover_viewer .wptpa_elastic_side path {";
    style += "fill: " + settings.playerBG + ";";
    style += "}";
    style += "#" + id + " .wptpa_controls {";
    style += "background: " + settings.playerBG + ";";
    style += "}";
    style += "#" + id + " .wptpa_heading {";
    style += "color: " + settings.playerTextCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_marquee.on {";
    style += "border-left-color: " + settings.playerTextCLR + ";";
    style += "border-right-color: " + settings.playerTextCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_heading .wptpa_open_nw,";
    style += "#" + id + " .wptpa_main_controls .wptpa_playback,";
    style += "#" + id + " .wptpa_main_controls .wptpa_prev,";
    style += "#" + id + " .wptpa_main_controls .wptpa_repeat,";
    style += "#" + id + " .wptpa_main_controls .wptpa_next,";
    style += "#" + id + " .wptpa_main_controls .wptpa_shuffle,";
    style += "#" + id + " .wptpa_main_controls .wptpa_share,";
    style += "#" + id + " .wptpa_console .wptpa_close_console,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_one_item_optional,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_playlist_toggle,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_mute,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_one_item_optional{";
    style += "fill: " + settings.buttonCLR + ";";
    style += "stroke: " + settings.buttonCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_heading .wptpa_open_nw:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_playback:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_playback:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_prev:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_repeat:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_next:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_shuffle:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_share:hover,";
    style += "#" + id + " .wptpa_console .wptpa_close_console:hover,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_one_item_optional:hover,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_playlist_toggle:hover,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_mute:hover,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_one_item_optional:hover,";
    style += "#" + id + " .wptpa_main_controls .wptpa_repeat.active,";
    style += "#" + id + " .wptpa_main_controls .wptpa_shuffle.active,";
    style += "#" + id + " .wptpa_main_controls .wptpa_share.active,";
    style += "#" + id + " .wptpa_additional_controls .wptpa_playlist_toggle.active{";
    style += "fill: " + settings.buttonActiveCLR + ";";
    style += "stroke: " + settings.buttonActiveCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_seek {";
    style += "background: " + settings.seekBarCLR + " !important;";
    style += "}";
    style += "#" + id + ".wptpa_loading .wptpa_seek:before,";
    style += "#" + id + ".wptpa_loading .wptpa_seek:after{";
    style += "background: " + settings.timeCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_progress {";
    style += "background: " + settings.progressBarCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_progress .wptpa_handle{";
    style += "fill: " + settings.progressBarCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_main_controls .wptpa_handle .handlebg{";
    style += "fill: " + settings.seekBarCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_current,";
    style += "#" + id + " .wptpa_duration,";
    style += "#" + id + " .wptpa_sng_info{";
    style += "color: " + settings.timeCLR + ";";
    style += "}";

    style += "#" + id + " .wptpa_volume_range:before {";
    style += "background: " + settings.seekBarCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_volume {";
    style += "background: " + settings.progressBarCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_volume_value {";
    style += "background: " + settings.progressBarCLR + ";";
    style += "color: " + settings.timeCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_volume_value:before {";
    style += "border-color: " + settings.progressBarCLR + " transparent transparent transparent;";
    style += "}";
    style += "#" + id + " .wptpa_social_share svg{";
    style += "fill: " + settings.buttonCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_social_share svg:hover{";
    style += "fill: " + settings.buttonActiveCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_playlist_item,";
    style += "#" + id + " .wptpa_playlist_scroll_handle {";
    style += "background: " + settings.playlistBG + ";";
    style += "color: " + settings.playlistTextCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_playlist_item:hover,";
    style += "#" + id + " .wptpa_playlist_item.active{";
    style += "background: " + settings.playlistCurBG + " !important;";
    style += "color: " + settings.playlistTextCLR + " !important;";
    style += "}";
    style += "#" + id + " .wptpa_playlist_item .wptpa_marker {";
    style += "stroke: " + settings.playlistTextCLR + ";";
    style += "}";
    style += "#" + id + " .wptpa_stat_icon_sng,";
    style += "#" + id + " .wptpa_buy svg,";
    style += "#" + id + " .wptpa_download svg {";
    style += "fill: " + settings.playlistTextCLR + ";";
    style += "stroke: " + settings.playlistTextCLR + ";";
    style += "}";

    style += '</style>';
    $("head").append(style);
      
    // Формирируем код плеера
    $code = '<audio class="wptpa_audio" src="' + playlist[0].audio + '"></audio>'; // конейнер для аудио, Сразу вставляем первый трек
    // Если, включен компакт режим присваеваем основному контейнеру его класс
    if (settings.compactMode) {
      $tPlayer.addClass('wptpa_compact');
    }
    $code += '<div class="wptpa_player">';
    $code += '<div class="wptpa_cover_viewer">';
    $code += '<div id="wptpa_cover_loader"><svg class="wptpa_circular" viewBox="25 25 50 50"><circle class="wptpa_circular_path" cx="50" cy="50" r="20" fill="none" stroke-width="8" stroke-miterlimit="10"/></svg></div>';
    $code += '<ul class="wptpa_cover_wrapper">';
    // в цикле вставляем обложки в слайдер
    for (i = 0; i < playlist.length; i++) {
      $code += '<li class="wptpa_cover"><img src="' + playlist[i].cover + '" /></li>';
    }
    $code += '</ul>';
    $code += '<svg class="wptpa_elastic_side" width="40px" height="200px"><path d="M40,0H20c0,0,0,40.667,0,100c0,60,0,100,0,100h20V0z"></path></svg>';
    $code += '</div>';
    $code += '<div class="wptpa_controls">';
    $code += '<div class="wptpa_heading"><div class="wptpa_marquee"><div>';
    $code += '<span data-shoutcast-value="songtitle"></span>';
    $code += '</div>';
    $code += '</div>';
    $code += '</div>';
    $code += '<div class="wptpa_main_controls">';
    $code += '<svg class="wptpa_playback"><path d="M0,0 10,5 10,15 0,20 M10,5 20,10 20,10 10,15 z"></path></svg>';
    $code += '<div class="wptpa_seek">';
    $code += '<div class="wptpa_progress">';
    $code += '<svg class="wptpa_handle" width="10px" height="20px"><path d="M1,0 10,0 10,20 1,20z" class="handlebg"></path><path d="M0,0h5c0,0,0,2.5,0,10c0,7.5,0,10,0,10H0V0z" class="handle_path"></path></svg></div>';
    $code += '<div class="wptpa_current">00:00</div><div class="wptpa_duration">00:00</div></div>';
    
    // Если треков больше одного - выводим кнопки prev, repeat, next
    if (playlist.length > 1) {
      $code += '<svg class="wptpa_prev"><path d="M10,0 10,20 0,10 M20,0 20,20 10,10 z"></path></svg>';
      $code += '<svg class="wptpa_repeat"><g><path d="M18.5,10c0,4.693-3.807,8.5-8.5,8.5c-4.694,0-8.5-3.807-8.5-8.5c0-4.694,3.806-8.5,8.5-8.5c2.156,0,4.126,0.803,5.625,2.128" fill="none" stroke-width="3px"></path><path d="M12,7 19,7 19,0z"></path></g></svg>';
      $code += '<svg class="wptpa_next"><path d="M0,0 10,10 0,20 M10,0 20,10 10,20 z"></path></svg>';
    }
    // Если треков больше одного и опция shuffle разрешена - выводим ее кнопку
    if (playlist.length > 1 && settings.shuffle) {
      $code += '<svg class="wptpa_shuffle"><path class="spath" d="M0,4.5 5,4.5 14,15.5 17,15.5 M0,15.5 5,15.5 14,4.5 17,4.5" fill="none" stroke-width="3px"></path><path class="sat" d="M16,0 20,4.5 16,9z"></path><path class="sab" d="M16,11 20,15.5 16,20z"></path></svg>';
    }
    // Если треков больше одного и опция share разрешена - выводим ее кнопку
    if (settings.share) {
      $code += '<svg class="wptpa_share"><path class="shapath" d="M4,10 16,16 M16,4 4,10" fill="none" stroke-width="3px"></path><circle class="shact" cx="16" cy="4" r="4"></circle><circle class="shacm" cx="4" cy="10" r="4"></circle><circle class="shacb" cx="16" cy="16" r="4"></circle></svg>';
    }
    $code += '</div>';
    $code += '<div class="wptpa_additional_controls">';
    // Если треков больше одного выводим кнопку toggle playlist, если трек один, в зависимости от значения опционального типа выводим - либо кнопку скачать, либо купить, либо заглушку для верстки
    if (playlist.length > 1) {
      $code += '<svg class="wptpa_playlist_toggle"> <path d="M0,0 20,0 20,4 0,4 Z M0,8 20,8 20,12 0,12 Z M0,16 20,16 20,20 0,20z"></path></svg>';
    } else {
      
      if (!playlist[0].dwn) {
        playlist[0].dwn = "";
      }
      if (!playlist[0].buy) {
        playlist[0].buy = "";
      }
      
      if (playlist[0].dwn !== '') {
        $code += '<a class="wptpa_one_item_optional add_to_stat" href="' + playlist[0].dwn + '" target="_blank"><svg class="wptpa_one_item_dwn" width="20px" height="20px"><path d="M10,2 10,18 M2,10 10,18 18,10" fill="none" stroke-width="4px" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>';
      }
      if (playlist[0].buy !== '') {
        $code += '<a class="wptpa_one_item_optional" href="' + playlist[0].buy + '" target="_blank"><svg class="wptpa_one_item_buy" width="20px" height="20px"><path d="M1.5,1.5 5,1.5 5,13.5 15,13.5 18.5,6.5 15,6.5" fill="none" stroke-width="3px" stroke-linecap="round" stroke-linejoin="round"></path><circle cx="7" cy="18" r="2"/><circle cx="13" cy="18" r="2"/></svg></a>';
      }
      if (playlist[0].buy === '' && playlist[0].dwn === '') {
        $code += '<div></div>';
      }
    }
    $code += '<div class="wptpa_soundbar">';
    $code += '<svg class="wptpa_mute" width="20" height="20"><path class="muteIcn" d="M10,18V2L4.112,7H0v6h4.096L10,18z"></path><path class="muteIcnR" d="M14,1c0,0,5,2.539,5,9c0,6.498-5,9-5,9" fill="none" stroke-width="1.75" stroke-linecap="round"></path><path class="muteIcnM" d="M12.901,4.25c0,0,3.197,1.622,3.197,5.75c0,4.149-3.197,5.75-3.197,5.75" fill="none" stroke-width="1.75" stroke-linecap="round"></path><path class="muteIcnL" d="M11.734,7.25c0,0,1.531,0.775,1.531,2.75c0,1.985-1.531,2.75-1.531,2.75" fill="none" stroke-width="1.75" stroke-linecap="round"></path><path class="mutedIcn" d="M1,10 1,10 M1,10 1,10" fill="none" stroke-width="1.75" stroke-linecap="round"></path></svg>';
    $code += '<div class="wptpa_volume_range"><div class="wptpa_volume"><div class="wptpa_volume_value"></div></div></div>';
    $code += '</div>';
    $code += '</div>';
    $code += '</div></div>';
    $code += '<div class="wptpa_social_share">';
    $code += '<a href="http://www.facebook.com/sharer.php?u=' + encodeURIComponent(location.href) + '" target="_blank" class="wptpa_fb"><svg width="20" height="20"><path d="M20,3.337C20,1.583,18.418,0,16.664,0H3.333C1.583,0,0,1.583,0,3.337v13.327C0,18.42,1.583,20,3.333,20H10 v-7.556H7.558V9.113H10v-1.3c0-2.238,1.682-4.256,3.75-4.256h2.695v3.336H13.75c-0.293,0-0.641,0.356-0.641,0.893v1.328h3.337 v3.332h-3.337V20h3.555C18.418,20,20,18.42,20,16.664V3.337z M20,3.337"/></svg></a>';
    $code += '<a href="http://twitter.com/share?text=' + encodeURIComponent(settings.twitterText) + '&url=' + encodeURIComponent(location.href) + '" target="_blank" class="wptpa_twitter"><svg width="20" height="20"><path d="M16.246,0h-12.5C1.678,0,0,1.678,0,3.747v12.499C0,18.321,1.678,20,3.747,20h12.5C18.321,20,20,18.321,20,16.245V3.747 C20,1.678,18.321,0,16.246,0L16.246,0z M14.978,7.757l0.006,0.317c0,3.253-2.479,7.005-7.007,7.005 c-1.391,0-2.684-0.407-3.772-1.11c0.189,0.025,0.386,0.038,0.586,0.038c1.155,0,2.216-0.396,3.058-1.056 c-1.079-0.021-1.982-0.734-2.3-1.711c0.152,0.032,0.305,0.045,0.464,0.045c0.225,0,0.445-0.031,0.647-0.086 c-1.124-0.228-1.972-1.221-1.972-2.411V8.757c0.33,0.184,0.708,0.293,1.111,0.306C5.139,8.624,4.706,7.866,4.706,7.018 c0-0.452,0.122-0.878,0.336-1.239c1.208,1.489,3.026,2.466,5.072,2.57c-0.044-0.178-0.061-0.367-0.061-0.563 c0-1.354,1.098-2.459,2.459-2.459c0.708,0,1.349,0.3,1.8,0.775c0.556-0.109,1.087-0.311,1.563-0.592 c-0.183,0.575-0.573,1.056-1.086,1.361c0.5-0.061,0.977-0.195,1.416-0.391C15.874,6.976,15.453,7.409,14.978,7.757L14.978,7.757z M14.978,7.757"/></svg></a>';
    $code += '<a href="https://plus.google.com/share?url=' + encodeURIComponent(location.href) + '" target="_blank" class="wptpa_gp"><svg width="20" height="20"><path d="M16.246,0h-12.5C1.678,0,0,1.678,0,3.747v12.499C0,18.321,1.678,20,3.747,20h12.5C18.321,20,20,18.321,20,16.245V3.747 C20,1.678,18.321,0,16.246,0L16.246,0z M7.207,16.729c-2.208,0-4.076-0.903-4.076-2.344c0-1.46,1.703-2.868,3.912-2.868 l0.696-0.006c-0.305-0.293-0.544-0.661-0.544-1.105c0-0.262,0.086-0.519,0.202-0.745L7.031,9.673c-1.819,0-3.039-1.294-3.039-2.893 c0-1.569,1.684-2.923,3.465-2.923h3.992l-0.897,0.641H9.288c0.836,0.323,1.289,1.3,1.289,2.306c0,0.843-0.47,1.563-1.129,2.081 C8.808,9.387,8.686,9.6,8.686,10.027c0,0.366,0.689,0.982,1.048,1.239c1.056,0.743,1.392,1.434,1.392,2.588 C11.126,15.295,9.734,16.729,7.207,16.729L7.207,16.729z M17.498,8.77h-2.496v2.497H13.75V8.77h-2.502V7.501h2.502V4.998h1.252 v2.503h2.496V8.77z M17.498,8.77 M9.143,6.877C8.965,5.536,7.988,4.449,6.964,4.418c-1.025-0.03-1.716,1.001-1.538,2.351 c0.176,1.348,1.153,2.471,2.178,2.502C8.629,9.3,9.319,8.233,9.143,6.877L9.143,6.877z M9.143,6.877 M8.459,12.048c-0.298-0.1-0.635-0.16-0.989-0.16c-1.531-0.017-2.898,0.935-2.898,2.075c0,1.161,1.104,2.131,2.63,2.131 c2.154,0,2.899-0.909,2.899-2.075c0-0.134-0.012-0.274-0.048-0.408C9.887,12.951,9.288,12.621,8.459,12.048L8.459,12.048z M8.459,12.048"/></svg></a>';
    $code += '<a href="http://tumblr.com/widgets/share/tool?canonicalUrl=' + encodeURIComponent(location.href) + '" target="_blank" class="wptpa_tmblr"><svg width="20" height="20"><path d="M16.246,0h-12.5C1.678,0,0,1.678,0,3.747v12.499C0,18.321,1.678,20,3.747,20h12.5C18.321,20,20,18.321,20,16.245V3.747 C20,1.678,18.321,0,16.246,0L16.246,0z M13.75,9.252h-3.002v2.74c0,0.696-0.007,1.099,0.066,1.294s0.257,0.403,0.452,0.52 c0.269,0.157,0.573,0.236,0.915,0.236c0.604,0,0.965-0.079,1.568-0.475v1.807c-0.513,0.244-0.964,0.385-1.379,0.48 c-0.415,0.093-0.86,0.141-1.349,0.141c-0.549,0-0.873-0.067-1.293-0.208c-0.422-0.133-0.781-0.334-1.075-0.59 c-0.298-0.258-0.507-0.525-0.622-0.818c-0.118-0.287-0.172-0.702-0.172-1.259V8.917H6.25V7.219C6.72,7.067,7.251,6.842,7.585,6.56 C7.921,6.274,8.19,5.932,8.392,5.529C8.599,5.126,8.74,4.62,8.813,3.998h1.935V7h3.002V9.252z M13.75,9.252"/></svg></a>';
    $code += '</div>';
    // Формирируем плейлист
    $code += '<div class="wptpa_playlist_wrapper_grand">';
    $code += '<div class="wptpa_playlist_wrapper">';
    $code += '<div class="wptpa_playlist_scroll"><div class="wptpa_playlist_scroll_handle"></div></div>';
    $code += '<ul class="wptpa_playlist" style="display: none;">';
    // в цикле формирируем треклист
    for (i = 0; i < playlist.length; i++) {
      if (playlist[i].type === 'radio') {
        title = playlist[i].artist;
        tips = playlist[i].artist;
      } else {
        title = playlist[i].artist + ' - ' + playlist[i].title;
        tips = playlist[i].artist + ' - ' + playlist[i].title;
      }
      if (!playlist[i].radiotype) {
        playlist[i].radiotype = "";
      }
      if (!playlist[i].dwn) {
        playlist[i].dwn = "";
      }
      if (!playlist[i].buy) {
        playlist[i].buy = "";
      }
      $code += '<li class="wptpa_playlist_item" data-artist="' + playlist[i].artist + '" data-title="' + playlist[i].title + '" data-audio="' + playlist[i].audio + '" data-cover="' + playlist[i].cover + '" data-type="' + playlist[i].type + '" data-radiotype="' + playlist[i].radiotype + '"><svg class="wptpa_marker" width="40px" height="40px"><path d="M20,20 20,20 M20,20 20,20 M20,20 20,20" stroke-linecap="round" stroke-miterlimit="10"></path></svg><div class="wptpa_item_name" title="' + tips + '" style="-webkit-animation-delay: ' + (75 * i) + 'ms; -o-animation-delay: ' + (75 * i) + 'ms; animation-delay: ' + (75 * i) + 'ms;">' + title + '</div>';
      
      // В зависимости от значения опционального типа выводим - либо кнопку скачать, либо купить
      if (playlist[i].dwn !== '') {
        $code += '<a href="' + playlist[i].dwn + '" class="wptpa_download add_to_stat" target="_blank"><svg class="wptpa_optional_marker" width="40px" height="40px"><path d="M0,10 0,30" style="stroke-width:1px"></path><path d="M20,12 20,28 M28,20 20,28 12,20" fill="none" stroke-width="4px" stroke-linecap="round"></path></svg></a>';
      }
      if (playlist[i].buy !== '') {
        $code += '<a href="' + playlist[i].buy + '" class="wptpa_buy" target="_blank"><svg class="wptpa_optional_marker" width="40px" height="40px"><path d="M0,10 0,30" style="stroke-width:1px"></path><path d="M25,16.5 28.5,16.5 25,23.5 15,23.5 15,11.5 11.5,11.5" fill="none" stroke-width="3px" stroke-linecap="round" stroke-linejoin="round"></path><circle stroke="none" cx="17" cy="28" r="2"/><circle stroke="none" cx="23" cy="28" r="2"/></svg></a>';
      }
      $code += '</li>';
    }
    $code += '</ul>';
    $code += '</div>';
    $code += '</div>';
    $code += '<div class="wptpa_modal"><div class="wptpa_overlay"></div><div class="wptpa_info_wrapper"><div class="wptpa_info_heading"></div><div class="wptpa_info_container"></div></div></div></div>';
    $tPlayer.append($code);  // вставляем сформирированный код в основной контейнер

    // Заполняем переменные контейниров
    $player = $tPlayer.find('.wptpa_player');
    $cover_viewer = $tPlayer.find('.wptpa_cover_viewer');
    $cover_wrapper = $tPlayer.find('.wptpa_cover_wrapper');
    $cover = $tPlayer.find('.wptpa_cover');
    $heading = $tPlayer.find('.wptpa_heading');
    $marquee = $tPlayer.find('.wptpa_marquee');
    $playback = $tPlayer.find('.wptpa_playback');
    $audio = $tPlayer.find('.wptpa_audio');
    $seek = $tPlayer.find('.wptpa_seek');
    $progress = $tPlayer.find('.wptpa_progress');
    $current = $tPlayer.find('.wptpa_current');
    $duration = $tPlayer.find('.wptpa_duration');
    $previous = $tPlayer.find('.wptpa_prev');
    $repeat = $tPlayer.find('.wptpa_repeat');
    $next = $tPlayer.find('.wptpa_next');
    $shuffle = $tPlayer.find('.wptpa_shuffle');
    $share = $tPlayer.find('.wptpa_share');
    $fb = $tPlayer.find('.wptpa_fb');
    $twitter = $tPlayer.find('.wptpa_twitter');
    $gp = $tPlayer.find('.wptpa_gp');
    $tmblr = $tPlayer.find('.wptpa_tmblr');
    $playlist_toggle = $tPlayer.find('.wptpa_playlist_toggle');
    $mute = $tPlayer.find('.wptpa_mute');
    $volume_range = $tPlayer.find('.wptpa_volume_range');
    $volume = $tPlayer.find('.wptpa_volume');
    $volumeValue = $tPlayer.find('.wptpa_volume_value');
    $playlist = $tPlayer.find('.wptpa_playlist');
    $wptpa_playlist_scroll = $tPlayer.find('.wptpa_playlist_scroll');
    $wptpa_playlist_scroll_handle = $tPlayer.find('.wptpa_playlist_scroll_handle');
    $wptpa_playlist_item = $tPlayer.find('.wptpa_playlist_item');
    $playlistItem = $tPlayer.find('.wptpa_playlist_item>.wptpa_item_name');
    $wptpa_dwn = $tPlayer.find('.add_to_stat');
    $modal = $tPlayer.find('.wptpa_modal');
    $overlay = $tPlayer.find('.wptpa_overlay');
    $info_container = $tPlayer.find('.wptpa_info_container');
    $info_heading = $tPlayer.find('.wptpa_info_heading');
    countSongs = $playlist.children().length;
    $wptpa_cover_loader = $tPlayer.find('#wptpa_cover_loader');
    $info_area = $tPlayer.find(".wptpa_sng_info");


    // Функции
    function marquee() {
      // проверяем влазит ли название в видимую зону, если нет включаем бегущую строку
      if ($marquee.width() < $marquee.find("span").width()) {
        $marquee.addClass("on");
      } else {
        $marquee.removeClass("on");
      }
    }
    
    // Загружаем инфу о треке
    function handleSong() {
      var slideWidth = $cover.width(), title, tips; // узнаем ширину слайда
      $audio[0].src = currentSong.data('audio'); // получаем ссылку на аудио
      $audio[0].load(); // загружаем трек
      $playlist.children().removeClass('active'); // удаляем клас актив с плейлиста
      // Пошаговая анимация заголовка
      $heading.find('span').removeClass('handletitle_in').addClass('handletitle_out'); // анимация ухода тайтла
      setTimeout(function () { // через 300 мс запускаем
        // удаляем клас ухода тайтла, меняем тайтл, присваиваем клас появления
        if (currentSong.data('type') === "radio") {
          title = '<b>' + currentSong.data('artist') + '</b>';
          tips = currentSong.data('artist');
        } else {
          title = '<b>' + currentSong.data('artist') + '</b> - ' + currentSong.data('title');
          tips = currentSong.data('artist') + ' - ' + currentSong.data('title');
        }
        $heading.find('span').removeClass('handletitle_out').html(title).attr('title', tips).addClass('handletitle_in');
		    // нужна ли бегущая строка
        marquee();
      }, 300);
      $cover_wrapper.stop(true, true).animate({ left : -currentSong.index() * slideWidth + 'px'}, 400, 'easeInSine'); // анимация слайдера каверов
      // Если индекс текущего трека, больше индекса текущего слайда то оттягуем эластик плеера в лево, если меньше и не равен 0 то в право
      if (currentSong.index() > currentSlide) {
        coverside.stop(true, true).animate({d: 'M40,0H20c0,0-10,40.667-10,100c0,60,10,100,10,100h20V0z'}, 500 * 0.5, mina.easeOut, function () {
          coverside.stop(true, true).animate({d: 'M40,0H20c0,0,0,40.667,0,100c0,60,0,100,0,100h20V0z'}, 500 * 3, mina.elastic);
        });
        currentSlide = currentSong.index(); // присваиваем индекс текущего трека к текущему слайду
      } else if (currentSong.index() < currentSlide && currentSlide !== 0) {
        coverside.stop(true, true).animate({d: 'M40,0H20c0,0,10,40.667,10,100c0,60-10,100-10,100h20V0z'}, 500 * 0.5, mina.easeOut, function () {
          coverside.stop(true, true).animate({d: 'M40,0H20c0,0,0,40.667,0,100c0,60,0,100,0,100h20V0z'}, 500 * 3, mina.elastic);
        });
        currentSlide = currentSong.index(); // присваиваем индекс текущего трека к текущему слайду
      }
      currentSong.addClass('active'); // присваеваем текущему треку класс активный
    }

    function resizeEl() {
      if ($tPlayer.parent().width() < 600) {
        $tPlayer.addClass('wptpa_compact');
      } else {
        if (!settings.compactMode) {
          $tPlayer.removeClass('wptpa_compact');
        }
      }
      var width = $cover_viewer.width(); // получаем ширину контейнера каверов, если не компакт режим изменяем ширину с 220 на 200
      if (width === 220) {
        width = 200;
      }
		// Если, включен компакт режим присваеваем врапперу слайдера ширину и высоту равную контейнеру каверов, а также контейнеру слайдера высоту и кажому слайду
      if ($tPlayer.hasClass('wptpa_compact')) {
        $cover_wrapper.css({'width': (width * countSongs), 'height': width});
        $cover_wrapper.parent().css({'height': width});
        $cover.each(function () {
          $(this).css({'width': width, 'height': width});
        });
      } else {
        // если не компакт то присваеваем ширину для враппера слайдера и слайдам
        $cover_wrapper.css({'width': (width * countSongs), 'height': 200});
        $cover_wrapper.parent().css({'height': 200});
        $cover.each(function () {
          $(this).css({'width': width, 'height': 200});
        });
      }
    }

    $(window).resize(function () {
      resizeEl();
    });

    function shuffle() {
      var data, allSongPls, allSongCover, getRandom;
      if (settings.shuffle && playlist.length > 1) {
        shuffleIcnP.animate({d: "M0,4.5 0,4.5 0,15.5 17,15.5 M0,15.5 0,15.5 0,4.5 17,4.5"}, 250, mina.easeout, function () {
          shuffleIcnP.animate({d: "M0,4.5 5,4.5 14,15.5 17,15.5 M0,15.5 5,15.5 14,4.5 17,4.5"}, 600, mina.easeOutElastic);
        });
        shuffleIcnAT.animate({d: "M16,2 20,4.5 16,7z"}, 250, mina.easeout, function () {
          shuffleIcnAT.animate({d: "M16,0 20,4.5 16,9z"}, 600, mina.easeOutElastic);
        });
        shuffleIcnAB.animate({d: "M16,13 20,15.5 16,18z"}, 250, mina.easeout, function () {
          shuffleIcnAB.animate({d: "M16,11 20,15.5 16,20z"}, 600, mina.easeOutElastic);
        });
      }
      $shuffle.toggleClass('active');
      shuffleMode = !shuffleMode;
      if (shuffleMode) {
        allSongPls = $wptpa_playlist_item.get();
        allSongCover = $cover.get();
        getRandom = function (max) {
          return Math.floor(Math.random() * max);
        };
        $.each(allSongPls, function (idx, itm) {
          var random = getRandom(allSongPls.length);
          $playlist.append(allSongPls[random]);
          $cover_wrapper.append(allSongCover[random]);
          allSongPls.splice(random, 1);
          allSongCover.splice(random, 1);
        });
      } else {
        $.each(playlistOrder, function (idx, itm) {
          $playlist.append(playlistOrder[idx]);
        });
        $.each(coverOrder, function (idx, itm) {
          $cover_wrapper.append(coverOrder[idx]);
        });
      }
    }
    
    // Функция при запуске скрипта
    function init() {
      resizeEl();
      // Если включен промо режим, создаем аудио обьект, загружаем в него ссылку на промо
      if (settings.promoMode) {
        $promo = new Audio();
        $promo.src = settings.promo;
        $promo.load();
      }
      var width = $cover_viewer.width(); // получаем ширину контейнера каверов, если не компакт режим изменяем ширину с 220 на 200
      if (width === 220) {
        width = 200;
      }
      // Если, включен компакт режим присваеваем врапперу слайдера ширину и высоту равную контейнеру каверов, а также контейнеру слайдера высоту и кажому слайду
      if ($tPlayer.hasClass('wptpa_compact')) {
        $cover_wrapper.css({'width': (width * countSongs), 'height': width});
        $cover_wrapper.parent().css({'height': width});
        $cover.each(function () {
          $(this).css({'width': width, 'height': width});
        });
      } else {
        // если не компакт то присваеваем ширину для враппера слайдера и слайдам
        $cover_wrapper.css('width', (width * countSongs));
        $cover.each(function () {
          $(this).css('width', width);
        });
      }
      // выбираем первый трек
      currentSong = $playlist.children().first();
      currentSlide = currentSong.index(); // текущий слайд равен индеку текущего трека
      // обьявляем снапы
      playIcon = Snap(currentSong.find('.wptpa_marker')[0]).select('path');
      coverside = Snap($tPlayer.find('.wptpa_elastic_side')[0]).select('path');
      open_nw = Snap($tPlayer.find('.wptpa_open_nw')[0]).select('path');
      playbackIcn = Snap($tPlayer.find('.wptpa_playback')[0]).select('path');
      seekHandleIcn = Snap($tPlayer.find('.wptpa_handle')[0]).select('.handle_path');
      if (countSongs > 1) {  //обьявляем только если треков больше одного
        prevIcn = Snap($tPlayer.find('.wptpa_prev')[0]).select('path');
        repeatIcn = Snap($tPlayer.find('.wptpa_repeat')[0]).select('g');
        nextIcn = Snap($tPlayer.find('.wptpa_next')[0]).select('path');
        if (settings.shuffle) {
          shuffleIcnP = Snap($tPlayer.find('.wptpa_shuffle')[0]).select('.spath');
          shuffleIcnAT = Snap($tPlayer.find('.wptpa_shuffle')[0]).select('.sat');
          shuffleIcnAB = Snap($tPlayer.find('.wptpa_shuffle')[0]).select('.sab');
        }
        playlist_toggleIcn = Snap($tPlayer.find('.wptpa_playlist_toggle')[0]).select('path');
      }
      if (settings.share) { // если разрешенна шара
        shareIcnP = Snap($tPlayer.find('.wptpa_share')[0]).select('.shapath');
        shareIcnCT = Snap($tPlayer.find('.wptpa_share')[0]).select('.shact');
        shareIcnCM = Snap($tPlayer.find('.wptpa_share')[0]).select('.shacm');
        shareIcnCB = Snap($tPlayer.find('.wptpa_share')[0]).select('.shacb');
      }
      muteIcn = Snap($tPlayer.find('.wptpa_mute')[0]).select('.muteIcn');
      mutedIcn = Snap($tPlayer.find('.wptpa_mute')[0]).select('.mutedIcn');
      muteIcnL = Snap($tPlayer.find('.wptpa_mute')[0]).select('.muteIcnL');
      muteIcnM = Snap($tPlayer.find('.wptpa_mute')[0]).select('.muteIcnM');
      muteIcnR = Snap($tPlayer.find('.wptpa_mute')[0]).select('.muteIcnR');
      handleSong(); // запускаем функцию обновления инфы
	  
	  
	  
      playlistOrder = $wptpa_playlist_item.get();
      coverOrder = $cover.get();
    }

    // Анимация иконки воспроизведения текущего трека
    function playIconAnim() {
      playIcon.stop(true, true).animate({d: 'M12,18 12,22 M28,15 28,25 M20,12 20,28', 'stroke-width': 4}, 500, mina.easeInOutCirc, function () {
        playIcon.stop(true, true).animate({d: 'M28,15 28,25 M20,12 20,28 M12,18 12,22', 'stroke-width': 4}, 500, mina.easeInOutCirc, function () {
          playIcon.stop(true, true).animate({d: 'M20,12 20,28 M12,18 12,22 M28,15 28,25 ', 'stroke-width': 4}, 500, mina.easeInOutCirc, function () {
            playIconAnim();
          });
        });
      });
    }

    // Анимация иконки остановки текущего трека
    function playIconAnimStop() {
      playIcon.stop(true, true).animate({d: 'M20,20 20,20 M20,20 20,20 M20,20 20,20', 'stroke-width': 6}, 500, mina.bounce);
    }

    // Функция playbak
    function playback() {
      // проверяем все плееры, если есть воспроизведение, сверяем его ссылку трека с текущим пллером если совпадает ставим на паузу
      $('audio').each(function () {
        if (!$(this)[0].paused) {
          if ($(this)[0].src !== $audio[0].src) {
            $(this)[0].pause();
          }
        }
      });
      // если на паузе анимируем иконку плейбека и воспроизводим трек
      if ($audio[0].paused) {
        playbackIcn.animate({d: "M2,3 10,6.5 10,13.5 2,17 M10,6.5 18,10 18,10 10,13.5 Z"}, 150, mina.easeout, function () {
          playbackIcn.animate({d: "M0,0 8,0 8,20 0,20 M12,0 20,0 20,20 12,20 Z"}, 250, mina.easeOutBounce);
        });
        $audio[0].play();
      } else {
        // если воспроизводится сбрасываем таймер обновления тайтла для радио, отключаем иконку воспроизведения трека в плейлисте, анимация иконки плейбека, останавливаем воспроизведения
        playIconAnimStop();
        playbackIcn.animate({d: "M2,3 8,3 8,17 2,17 M12,3 18,3 18,17 12,17 Z"}, 150, mina.easeout, function () {
          playbackIcn.animate({d: "M0,0 10,5 10,15 0,20 M10,5 20,10 20,10 10,15 Z"}, 250, mina.easeOutBounce);
        });
        $audio[0].pause();
      }
    }

    // конвертор из минут в секунды
    function timeConvert(time) {
      var m, s;
      if (typeof (time) === undefined) {
        m = '00';
        s = '00';
      } else {
        m = Math.floor(time / 60) < 10 ? '0' + Math.floor(time / 60) : Math.floor(time / 60);
        s = Math.floor(time % 60) < 10 ? '0'  + Math.floor(time % 60) : Math.floor(time % 60);
      }
      return m + ':' + s;
    }

    // Функция prev
    function prev() {
      playIconAnimStop(); //отключаем иконку воспроизведения трека в плейлисте
      prevIcn.animate({d: "M12,3 12,17 2,10M18,3 18,17 8,10 Z"}, 175, mina.easeout, function () {
        prevIcn.animate({d: "M10,0 10,20 0,10 M20,0 20,20 10,10 Z"}, 600, mina.easeOutElastic);
      });
      if (currentSong.index() !== 0) { // проверяем, если текущ трек не равен 0, берем предыдущ трек в плейлисте
        currentSong = currentSong.prev();
        handleSong(); // обновляем инфу
        playback(); // запускаем
      } else { // если текущ трек равен 0
        if (repeatMode) { // если включ повтор плс
          currentSong = $playlist.children().last(); // текущ трек равен последнему в плс
          handleSong();// обновляем инфу
          playback();// запускаем
        } else { // если не включ повтор
          $cover_wrapper.addClass('shake_cover'); // на кавер вешаем анимацию отсуствия трека
          setTimeout(function () {
            $cover_wrapper.removeClass('shake_cover'); // удаляем анимацию, через 600мс
          }, 600);
          playbackIcn.animate({d: "M0,0 10,5 10,15 0,20 M10,5 20,10 20,10 10,15 Z"}, 250, mina.easeOutBounce); // возвращаем плейбак иконку
          $audio[0].pause(); //ставим на паузу
          $audio[0].currentTime = 0; // сбрасываем текущ время трека
        }
      }
    }

    // Функция next
    function next() {
      playIconAnimStop();
      nextIcn.animate({d: "M2,3 12,10 2,17 M8,3 18,10 8,17 Z"}, 175, mina.easeout, function () {
        nextIcn.animate({d: "M0,0 10,10 0,20 M10,0 20,10 10,20 Z"}, 600, mina.easeOutElastic);
      });
      if (currentSong.index() !== countSongs - 1) {// проверяем, если текущ трек не последнему, берем след трек в плейлисте
        currentSong = currentSong.next();
        handleSong();
        playback();
      } else {
		    if (repeatMode) {
          currentSong = $playlist.children().first();// текущ трек равен первому в плс
          handleSong();
          playback();
        } else {
          $cover_wrapper.addClass('shake_cover');
          setTimeout(function () {
            $cover_wrapper.removeClass('shake_cover');
          }, 600);
          playbackIcn.animate({d: "M0,0 10,5 10,15 0,20 M10,5 20,10 20,10 10,15 Z"}, 250, mina.easeOutBounce);
          $audio[0].pause();
          $audio[0].currentTime = 0;
        }
      }
    }

    // Функция слайдера перемотки и изменения громкости
    function createSeek() {
      var audio_duration,
        audio_currentTime = $audio[0].currentTime; // текущие время трека
      // если радио то переменная длительности трека равна 0, если не радио то берем длину трека
      if (currentSong.data('type') === "radio") {
        audio_duration = 0;
      } else {
        audio_duration = $audio[0].duration;
      }
      // запускаем слайдер перемотки
      $seek.slider({
        value: 0,
        step: 0.01,
        orientation: "horizontal",
        range: false,
        max: audio_duration,
        start: function (e, ui) {
          seeksliding = true; // включаем флаг для запрета изменений при перемотки, фикс что бы не дергался слайдер
          if (ui.value > audio_currentTime) {   // если текущие значение слайдера больше текущего времени то выгибаем слайдер в право, если меньве в лево
            seekHandleIcn.stop(true, true).attr({d: "M0,0h5c0,0,5,2.5,5,10c0,7.5-5,10-5,10H0V0z"});
          } else {
            seekHandleIcn.stop(true, true).attr({d: "M0,0h5c0,0-5,2.5-5,10c0,7.5,5,10,5,10H0V0z"});
          }
        },
        slide: function (e, ui) {
          if (ui.value > audio_currentTime) {
            audio_currentTime = ui.value; // присваем текущему времени текущие значение слайдера
            seekHandleIcn.stop(true, true).attr({d: "M0,0h5c0,0,5,2.5,5,10c0,7.5-5,10-5,10H0V0z"});
          } else {
            audio_currentTime = ui.value; // присваем текущему времени текущие значение слайдера
            seekHandleIcn.stop(true, true).attr({d: "M0,0h5c0,0-5,2.5-5,10c0,7.5,5,10,5,10H0V0z"});
          }
          $progress.css('width', ((ui.value * 100) / $audio[0].duration) + '%'); // анимируем прогресс
          $current.text(timeConvert(ui.value)); // устанавливаем время
        },
        stop: function (e, ui) {
          seekHandleIcn.animate({d: "M0,0h5c0,0,0,2.5,0,10c0,7.5,0,10,0,10H0V0z"}, 500 * 3, mina.elastic); // еластик анимация слайдера
          seeksliding = false; // выключ флаг
          if (currentSong.data('type') === "audio") { // если не радио, присваиваем текущие время с значения слайдера
            $audio[0].currentTime = ui.value;
          }
        }
      });
      // запускаем слайдер громкости
      $volume_range.slider({
        value: volume,
        step: 0.01,
        orientation: "horizontal",
        range: false,
        max: 1,
        animate: true,
        start: function (e, ui) {
          $volumeValue.show(); // показываем значение громкости
        },
        change: function (e, ui) {
          if (!$audio[0].muted) { // если не выключен звук
            $audio[0].volume = volume = ui.value; // присваиваем знач слайдера для громкости
            $volumeValue.text(Math.round($audio[0].volume * 100)); // меняем значение громкости
          }
        },
        slide: function (e, ui) {
          if (!$audio[0].muted) {
            $audio[0].volume = volume = ui.value;
            $volumeValue.text(Math.round($audio[0].volume * 100));
          }
        },
        stop: function (e, ui) {
          if (!$audio[0].muted) {
            $audio[0].volume = volume = ui.value;
            $volumeValue.text(Math.round($audio[0].volume * 100));
          }
          $volumeValue.hide(); // прячем значение громкости
        }
      });
    }

    function scrollCreate() {
	  // скролл плейлиста
      var heightScroll = songlimit * 40,
        heightPLs = $wptpa_playlist_item.length * 40 - heightScroll;
      $wptpa_playlist_scroll.slider({
        value: heightPLs,
        step: 40,
        orientation: "vertical",
        range: false,
        max: heightPLs,
        animate: true,
        slide: function (e, ui) {
		      var percent = ((heightPLs - ui.value) * 100) / heightPLs;
          $wptpa_playlist_scroll_handle.css({"top": ((heightScroll / 100) * percent) - percent * (40 / 100) + "px"});
          $playlist.stop(true, true).animate({"top": -(heightPLs / 100) * percent + "px"}, 50);
        },
        change: function (e, ui) {
		      var percent = ((heightPLs - ui.value) * 100) / heightPLs;
          $wptpa_playlist_scroll_handle.css({"top": ((heightScroll / 100) * percent) - percent * (40 / 100) + "px"});
          $playlist.stop(true, true).animate({"top": -(heightPLs / 100) * percent + "px"}, 50);
        }
      });
    }
    if ($wptpa_playlist_item.length > songlimit && songlimit !== 0) {
      $wptpa_playlist_scroll.show();
      scrollCreate();
    } else {
      $wptpa_playlist_scroll.hide();
    }
    // Функция togglePlaylist
    function togglePlaylist() {
      if (showPlaylist) { // в зависимости от того показан ли плейлист меняем иконку кнопки и прячем или показываем плс
        $playlist_toggle.addClass('active');
        playlist_toggleIcn.animate({d: "M2,8 18,8 18,12 2,12 Z M2,8 18,8 18,8 2,8 Z M2,8 18,8 18,12 2,12 Z "}, 200, mina.easeout, function () {
          playlist_toggleIcn.animate({d: "M2.832,0 20,17.168 17.168,20 0,2.832 Z M0,8 20,8 20,8 0,8 Z M0,17.168 17.168,0 20,2.832 2.832,20 Z"}, 400, mina.easeOutBounce);
        });
        $playlist.show().animate({height: countSongs * 40}, 400, 'easeOutCirc').addClass('visible');
      } else {
        $playlist_toggle.removeClass('active');
        playlist_toggleIcn.animate({d: "M2,8 18,8 18,12 2,12 Z M2,8 18,8 18,8 2,8 Z M2,8 18,8 18,12 2,12 Z"}, 200, mina.easeout, function () {
          playlist_toggleIcn.animate({d: "M0,0 20,0 20,4 0,4 Z M0,8 20,8 20,12 0,12 Z M0,16 20,16 20,20 0,20 Z"}, 400, mina.easeOutBounce);
        });
        $playlist.animate({height: 0}, 400, 'easeOutCirc', function () {
          $(this).hide().removeClass('visible');
        });
      }
    }

    init(); // запускаем стартовую ф-цию

    if (countSongs > 1) { // проверяем, если треков больше одного тогда проверяем отображать ли плейлист, если же трек 1 то прячем плейлист
      togglePlaylist();
    }
    
    // события плеера

    
    // playback
    $playback.bind('click', function () {
      if (settings.promoMode) { // если вкл промод, а трек на паузе запускаем таймер промо, если трек воспроизводится то обнуляем таймер промо
        if ($audio[0].paused) {
          promoInterval = setInterval(function () {
            $promo.play();
          }, settings.promoTime * 60000);
        } else {
          clearInterval(promoInterval);
        }
      }
      playback();
    });


    // кнопка предыдущий трек
    $previous.bind('click', function () {
      prev();
    });

    // активация/деактивация - Повторить плейлист
    $repeat.bind('click', function () {
      repeatIcn.animate({transform: 'r270,10,10s0.75,0.75,10,10'}, 250, mina.easeout, function () {
        repeatIcn.animate({transform: 'r360,10,10s1,1,10,10'}, 400, mina.easeOutBounce, function () {
          repeatIcn.attr({ transform: 'rotate(0 10 10)'});
        });
      });
      $repeat.toggleClass('active');
      repeatMode = !repeatMode;
    });

    // кнопка следующий трек
    $next.bind('click', function () {
      next();
    });

    // активация/деактивация - Случайное воспроизведение
    $shuffle.bind('click', function () {
      shuffle();
      handleSong();
      playback();
    });

    // Открытие share
    $share.bind('click', function () {
      $player.toggleClass('social');
      if ($player.hasClass('social')) {
        shareIcnP.animate({d: "M1.5,1.5 18.5,18.5 M18.25,1.5 1.5,18.5", 'stroke-width': 4}, 600, mina.easeOutBounce);
        shareIcnCT.animate({cx: 10, cy: 10}, 175, mina.easeout, function () {
          shareIcnCT.animate({cx: 10, cy: 10, r: 0}, 400, mina.easeOutCirc);
        });
        shareIcnCM.animate({cx: 10, cy: 10}, 175, mina.easeout, function () {
          shareIcnCM.animate({cx: 10, cy: 10, r: 0}, 400, mina.easeOutCirc);
        });
        shareIcnCB.animate({cx: 10, cy: 10}, 175, mina.easeout, function () {
          shareIcnCB.animate({cx: 10, cy: 10, r: 0}, 400, mina.easeOutCirc);
        });
      } else {
        shareIcnP.animate({d: "M4,10 16,16 M16,4 4,10", 'stroke-width': 3}, 600, mina.easeOutBounce);
        shareIcnCT.animate({cx: 16, cy: 4}, 175, mina.easeout, function () {
          shareIcnCT.animate({cx: 16, cy: 4, r: 4}, 400, mina.easeOutCirc);
        });
        shareIcnCM.animate({cx: 4, cy: 10}, 175, mina.easeout, function () {
          shareIcnCM.animate({cx: 4, cy: 10, r: 4}, 400, mina.easeOutCirc);
        });
        shareIcnCB.animate({cx: 16, cy: 16}, 175, mina.easeout, function () {
          shareIcnCB.animate({cx: 16, cy: 16, r: 4}, 400, mina.easeOutCirc);
        });
      }
    });

    $fb.bind('click', function (e) {
      e.preventDefault(); // отключаем переход по ссылке
      var social = window.open($(this).attr('href'), 'share', 'width=500,height=400,resizable=yes,scrollbars=yes,status=yes'); // открываем поп ап
    });
    $twitter.bind('click', function (e) {
      e.preventDefault();
      var social = window.open($(this).attr('href'), 'share', 'width=500,height=400,resizable=yes,scrollbars=yes,status=yes');
    });
    $gp.bind('click', function (e) {
      e.preventDefault();
      var social = window.open($(this).attr('href'), 'share', 'width=500,height=400,resizable=yes,scrollbars=yes,status=yes');
    });
    $tmblr.bind('click', function (e) {
      e.preventDefault();
      var social = window.open($(this).attr('href'), 'share', 'width=500,height=400,resizable=yes,scrollbars=yes,status=yes');
    });

    $overlay.click(function () { // клик по оверлею закрывает модалку только в том случаем если это не реклама
      if (!adsMode) {
        $modal.fadeOut();
      }
    });

    // Открытие/закрытие плейлиста
    $playlist_toggle.bind('click', function () {
      showPlaylist = !showPlaylist;
      togglePlaylist();
    });

    // Включение/выключение звука
    $mute.bind('click', function () {
      $audio[0].muted = !$audio[0].muted;
      mutedAnim = true;
      if ($audio[0].muted) {
        $volume.stop(true, true).animate({'width' : 0}, 200, 'easeOutCirc');
        $volumeValue.text('0');
        muteIcnL.animate({d: "M9,7c0,0,0-1.128,0,3 c0,4.149,0,3,0,3"}, 100, mina.easeout, function () {
          muteIcnM.animate({d: "M9,7c0,0,0-1.128,0,3 c0,4.149,0,3,0,3"}, 100, mina.easeout, function () {
            muteIcnR.animate({d: "M9,7c0,0,0-1.128,0,3 c0,4.149,0,3,0,3"}, 100, mina.easeout, function () {
              mutedIcn.attr({"d": "M15,10 15,10 M15,10 15,10"}).stop(true, true).animate({d: "M12.5,7.5 17.5,12.5 M17.5,7.5 12.5,12.5"}, 600, mina.easeOutElastic);
            });
          });
        });
      } else {
        $volume.stop(true, true).animate({'width' : volume * 100}, 200, 'easeOutCirc');
        $volumeValue.text(Math.round(volume * 100));
        if ($audio[0].volume >= 0.75) {
          mutedIcn.stop(true, true).animate({d: "M15,10 15,10 M15,10 15,10"}, 250, mina.easeout, function () {
            muteIcnR.animate({d: "M14,1c0,0,5,2.539,5,9c0,6.498-5,9-5,9"}, 100, mina.easeout, function () {
              mutedIcn.attr({"d": "M1,10 1,10 M1,10 1,10"});
              muteIcnM.animate({d: "M12.901,4.25c0,0,3.197,1.622,3.197,5.75c0,4.149-3.197,5.75-3.197,5.75"}, 100, mina.easeout, function () {
                muteIcnL.animate({d: "M11.734,7.25c0,0,1.531,0.775,1.531,2.75c0,1.985-1.531,2.75-1.531,2.75"}, 100, mina.easeout, function () {
                  mutedAnim = false;
                });
              });
            });
          });
        } else if ($audio[0].volume >= 0.5) {
          mutedIcn.stop(true, true).animate({d: "M15,10 15,10 M15,10 15,10"}, 250, mina.easeout, function () {
            mutedIcn.attr({"d": "M1,10 1,10 M1,10 1,10"});
            muteIcnM.animate({d: "M12.901,4.25c0,0,3.197,1.622,3.197,5.75c0,4.149-3.197,5.75-3.197,5.75"}, 100, mina.easeout, function () {
              muteIcnL.animate({d: "M11.734,7.25c0,0,1.531,0.775,1.531,2.75c0,1.985-1.531,2.75-1.531,2.75"}, 100, mina.easeout, function () {
                mutedAnim = false;
              });
            });
          });
        } else if ($audio[0].volume >= 0.25) {
          mutedIcn.stop(true, true).animate({d: "M15,10 15,10 M15,10 15,10"}, 250, mina.easeout, function () {
            mutedIcn.attr({"d": "M1,10 1,10 M1,10 1,10"});
            muteIcnL.animate({d: "M11.734,7.25c0,0,1.531,0.775,1.531,2.75c0,1.985-1.531,2.75-1.531,2.75"}, 100, mina.easeout, function () {
              mutedAnim = false;
            });
          });
        } else {
          mutedIcn.stop(true, true).animate({d: "M15,10 15,10 M15,10 15,10"}, 250, mina.easeout, function () {
            mutedIcn.attr({"d": "M1,10 1,10 M1,10 1,10"});
            mutedAnim = false;
          });
        }
      }
    });

    // Выбор трека, через плейлист
    $playlistItem.bind('click', function () {
      playIconAnimStop();
      if (!$audio[0].paused) {
        playback();
      }
      currentSong = $(this).parent();
      handleSong();
      playback();
    });

    // события медиа
    // когда загрузиласть метадата
    $audio.bind('loadedmetadata', function () {
      if (currentSong.data('type') === "radio") { // если радио то длительность равна нулю, иначе вычисляем
        $duration.text("00:00");
        $progress.parent().css('cursor', 'default'); // если радио убираем курсор перемотки с прогресса
      } else {
        $duration.text(timeConvert($audio[0].duration));
        $progress.parent().css('cursor', 'pointer'); // если не радио возращаем курсор перемотки с прогресса
      }
      createSeek(); // создаем слайдеры громкости и перемотки
      if ($wptpa_playlist_item.length > songlimit  && songlimit !== 0) {
        if (currentSong.index() + 1 > songlimit) {
          $wptpa_playlist_scroll.slider("value", ($wptpa_playlist_item.length * 40) - ((currentSong.index() + 1) * 40));
        }
      }
      $audio[0].volume = volume; // устанавливаем громкость
      if (!$audio[0].muted) {
        $volume.animate({'width': $audio[0].volume * 100 + '%'}, 250);
      }
      if (currentSong.data('type') === "radio") { // если радио то длительность равна нулю, иначе вычисляем
        $duration.fadeOut();
      } else {
        $duration.fadeIn(1000); // проявляем длительность, после того как она получена
      }
      $current.fadeIn(1000);// проявляем текущие время, после того как оно получено
      if (settings.autoplay) {
        playbackIcn.animate({d: "M2,3 10,6.5 10,13.5 2,17 M10,6.5 18,10 18,10 10,13.5 Z"}, 150, mina.easeout, function () {
          playbackIcn.animate({d: "M0,0 8,0 8,20 0,20 M12,0 20,0 20,20 12,20 Z"}, 250, mina.easeOutBounce);
        });
        $audio[0].play();
      }
    });
    // если изменилась длительность, и это не радио меняем значение если радио то показываем нули
    $audio.bind('durationchange', function () {
      if (currentSong.data('type') === "radio") {
        $duration.text('00:00');
      } else {
        $duration.text(timeConvert($audio[0].duration));
      }
      //createSeek();
    });
    // при переключении между плеерами отключаем иконки
    $audio.bind('pause', function () {
      playIconAnimStop();
      playbackIcn.stop(true, true).animate({d: "M2,3 8,3 8,17 2,17 M12,3 18,3 18,17 12,17 Z"}, 150, mina.easeout, function () {
        playbackIcn.stop(true, true).animate({d: "M0,0 10,5 10,15 0,20 M10,5 20,10 20,10 10,15 Z"}, 250, mina.easeOutBounce);
      });
    });

    // событие при изменении громкости
    $audio.bind('volumechange', function () {
      if (!mutedAnim) {
        $volume.css('width', $audio[0].volume * 100 + '%');
        if ($audio[0].volume >= 0.75) {
          muteIcnR.attr({d: "M14,1c0,0,5,2.539,5,9c0,6.498-5,9-5,9"});
        } else {
          muteIcnR.attr({d: "M9,7c0,0,0-1.128,0,3 c0,4.149,0,3,0,3"});
        }
        if ($audio[0].volume >= 0.5) {
          muteIcnM.attr({d: "M12.901,4.25c0,0,3.197,1.622,3.197,5.75c0,4.149-3.197,5.75-3.197,5.75"});
        } else {
          muteIcnM.attr({d: "M9,7c0,0,0-1.128,0,3 c0,4.149,0,3,0,3"});
        }
        if ($audio[0].volume >= 0.25) {
          muteIcnL.attr({d: "M11.734,7.25c0,0,1.531,0.775,1.531,2.75c0,1.985-1.531,2.75-1.531,2.75"});
        } else {
          muteIcnL.attr({d: "M9,7c0,0,0-1.128,0,3 c0,4.149,0,3,0,3"});
        }
        if ($audio[0].volume >= 0.01) {
          mutedIcn.attr({"d": "M1,10 1,10 M1,10 1,10"});
        } else {
          mutedIcn.attr({d: "M12.5,7.5 17.5,12.5 M17.5,7.5 12.5,12.5"});
        }
      }
    });

    // событие при изменении времени
    $audio.bind('timeupdate', function () {
      var currentTime = $audio[0].currentTime;
      if (!seeksliding) { // если идет перемотка, то не показываем текущее время трека
        $seek.slider('value', currentTime);
        $progress.css('width', ((currentTime * 100) / $audio[0].duration) + '%');
        $current.text(timeConvert($audio[0].currentTime));
      }
    });

    // анимируем иконку воспроизведения
    $audio.bind('playing', function () {
      $wptpa_cover_loader.stop(true, true).fadeOut(1000);
      playIcon = Snap(currentSong.find('.wptpa_marker')[0]).select('path');
      playIcon.stop(true, true).animate({d: 'M20,12 20,28 M12,18 12,22 M28,15 28,25', 'stroke-width': 4}, 500 * 3, mina.elastic, function () {
        playIconAnim();
      });
    });

    // события по окончанию
    $audio.bind('ended', function () {
      if (playlist.length > 1) {
        next(); // запускаем след трек
      } else {
        playbackIcn.stop(true, true).animate({d: "M2,3 8,3 8,17 2,17 M12,3 18,3 18,17 12,17 Z"}, 150, mina.easeout, function () {
          playbackIcn.stop(true, true).animate({d: "M0,0 10,5 10,15 0,20 M10,5 20,10 20,10 10,15 Z"}, 250, mina.easeOutBounce);
        });
        $audio[0].currentTime = 0;
      }
    });

	// Буферизация
    $audio.bind('progress', function (e) {
      var ranges = [], d, allbufer, per;
      for (i = 0; i < $audio[0].buffered.length; i++) {
        ranges.push([
          $audio[0].buffered.start(i),
          $audio[0].buffered.end(i)
        ]);
      }
      d = $audio[0].duration / 100;

      allbufer = 0;
      for (i = 0; i < $audio[0].buffered.length; i++) {
        allbufer += ranges[i][1] - ranges[i][0];
      }
      per = Math.floor(allbufer / d);
      if (per > 0 && per < 100) {
        per = (per > 100) ? per === 100 : per;
        //console.log(per + " %");
      }
    });


    // ошибки
    $audio.bind('abort', function () {
		/*
      $modal.fadeIn();
      $info_heading.text('Error:');
      $info_container.text('Sorry, but something went wrong, please refresh page');*/
      console.log('abort');
    });
    
    $audio.bind('error', function (event) {/*
      $modal.fadeIn();
      $info_heading.text('Error:');
      $info_container.text('Sorry, but something went wrong, please refresh page');*/
      console.log(event);
      if (event.target.error.code === 1) {
        console.log('You aborted the audio playback.');
      }
      if (event.target.error.code === 2) {
        console.log('A network error caused the audio download to fail.');
      }
      if (event.target.error.code === 3) {
        console.log('The audio playback was aborted due to a corruption problem or because the audio used features your browser did not support.');
      }
      if (event.target.error.code === 4) {
        console.log('The audio not be loaded, either because the server or network failed or because the format is not supported.');
      }
    });
    
    $audio.bind('waiting', function () {
      $wptpa_cover_loader.fadeIn();
    });

    $cover_wrapper.find('img').on('load', function () {
      countCover++;
      if (countCover === countSongs) {
        $cover_wrapper.fadeIn(1000);
        $wptpa_cover_loader.fadeOut(1000);
      }
    });

    // PROMO
    // Старт промо
    if (settings.promoMode) {
      $promo.addEventListener('playing', function () {
        clearInterval(promoInterval);
        $promo.volume = $audio[0].volume; // берм громкость для промо текущюю
        $info_heading.text('Advertising Time:'); // меняяем заголовок модалки
        $modal.fadeIn(); // показываем модалку
        playback(); // ставим на паузу трек
        adsMode = true; // флаг включенния рекламы
      });

      $promo.addEventListener('timeupdate', function () {
        $info_container.html('The advertisement will end after <b>' + timeConvert(($promo.duration - $promo.currentTime)) + '</b>'); // осталось до конца рекламы
      });

      // события по окончанию промо
      $promo.addEventListener('ended', function () {
        promoInterval = setInterval(function () {
          $promo.play();
        }, settings.promoTime * 60000);
        $modal.fadeOut(); // прячем модалку
        playback(); // возвращаем воспроизведение трека
        adsMode = false; // выключаем флаг
      });
    }
  };
}(jQuery));
