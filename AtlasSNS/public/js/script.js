// $(function () {
//   $('.menu-trigger').click(function () {
//     $(this).toggleClass('active');
//     if ($(this).hasClass('active')) {
//       $('.g-navi').addClass('active');
//       // 矢印の向きを変更するためにクラスを追加
//       $(this).addClass('arrow-up');
//     } else {
//       $('.g-navi').removeClass('active');
//       // 矢印の向きを変更するためにクラスを削除
//       $(this).removeClass('arrow-up');
//     }
//   });
// });

$(function () {
  $('.menu-trigger').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('#links01').addClass('active');
      // 矢印の向きを変更するためにクラスを追加
      $(this).addClass('arrow-up');
    } else {
      $('#links01').removeClass('active');
      // 矢印の向きを変更するためにクラスを削除
      $(this).removeClass('arrow-up');
    }
  });
});
