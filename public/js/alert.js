/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/
/******/
/******/ })()
;
function like(postId) {
  $(".like-btn").css('display','none');
  $(".unlike-btn").css('display','block');

  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/like/${postId}`,
    type: "POST",
  })
    .done(function (data, status, xhr) {
      console.log(data);
    })
    .fail(function (xhr, status, error) {
      console.log();
    });
}
function unlike(postId) {
  $(".unlike-btn").css('display','none');
  $(".like-btn").css('display','block');

  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/unlike/${postId}`,
    type: "POST",
  })
    .done(function (data, status, xhr) {
      console.log(data);
    })
    .fail(function (xhr, status, error) {
      console.log();
    });
}

$('.toggle_like').on('click', function ()
{
    //表示しているプロダクトのIDと状態、押下し他ボタンの情報を取得
    var thread_id = $(this).attr("thread_id");
    var like_val = $(this).attr("like_val");
    var button = $(this);

    if(like_val == '1'){

    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
        type: 'POST',
      url: `/unlike_theme/`+thread_id,
    }).done(function(data, status, xhr) {
        // 成功時の処理
      button.attr('like_val', '0');
      button.children().attr('src', '/image/like_off.svg');
      console.log(data);

    }).fail(function(xhr, status, error) {
        // 失敗時の処理
      console.log();
    });

    } else {

    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
        type: 'POST',
      url: `/like_theme/`+thread_id,
    }).done(function(data, status, xhr) {
        // 成功時の処理
          button.attr('like_val', '1');
      button.children().attr('src', '/image/like_on.svg');
      console.log(data);

    }).fail(function(xhr, status, error) {
        // 失敗時の処理
      console.log();
    });
  }

});
