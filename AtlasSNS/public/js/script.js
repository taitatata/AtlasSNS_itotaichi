// アコーディオンメニューの矢印調整
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

// 編集用モーダル
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.edit-button').forEach(function (button) {
    button.addEventListener('click', function () {
      const postId = this.getAttribute('data-id');  // ボタンからデータIDを取得
      const modal = document.getElementById('editModal');
      const postContent = document.getElementById('postContent');
      const form = document.getElementById('editForm');

      // Fetch post data from server
      fetch(`/posts/${postId}/edit`)
        .then(response => response.json())
        .then(data => {
          postContent.value = data.post;  // フォームのテキストエリアを更新
          form.action = `/posts/${postId}`;  // フォームのアクションを動的に更新
          modal.style.display = 'block';  // モーダルを表示
        })
        .catch(error => console.error('Error:', error));
    });
  });
});



// 削除用ボタン
document.querySelectorAll('.delete-button').forEach(button => {
  button.addEventListener('click', function (event) {
    event.preventDefault();  // デフォルトのフォーム送信を防止
    if (confirm('本当に削除しますか？')) {
      this.closest('form').submit();  // フォームを送信
    }
  });
});
