// アコーディオンメニューの矢印調整
document.addEventListener('DOMContentLoaded', function () {
    var menuTriggers = document.querySelectorAll('.menu_trigger');
    menuTriggers.forEach(function (trigger) {
        trigger.addEventListener('click', function () {
            this.classList.toggle('active');
            var links = document.getElementById('links01');
            if (this.classList.contains('active')) {
                links.classList.add('active');
                this.classList.add('arrow_up'); // 矢印の向きを変更するためにクラスを追加
            } else {
                links.classList.remove('active');
                this.classList.remove('arrow_up'); // 矢印の向きを変更するためにクラスを削除
            }
        });
    });
});

// 編集用モーダル
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit_button').forEach(function (button) {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-id');  // ボタンからデータIDを取得
            const modal = document.getElementById('editModal');
            const modalContent = modal.querySelector('.modal-content'); // モーダルの内容部分を取得
            const postContent = document.getElementById('postContent');
            const form = document.getElementById('editForm');
            const overlay = document.getElementById('overlay');

            // Fetch post data from server
            fetch(`/posts/${postId}/edit`)
                .then(response => response.json())
                .then(data => {
                    postContent.value = data.post;  // フォームのテキストエリアを更新
                    form.action = `/posts/${postId}`;  // フォームのアクションを動的に更新
                    modal.style.display = 'block';  // モーダルを表示
                    overlay.style.display = 'block'; // オーバーレイを表示
                })
                .catch(error => console.error('Error:', error));

            // モーダルの内容部分でのクリックイベントが伝播しないようにする
            modalContent.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
    });
    // オーバーレイをクリックした時にモーダルを閉じる
    const overlay = document.getElementById('overlay');
    overlay.addEventListener('click', function () {
        const modal = document.getElementById('editModal');
        modal.style.display = 'none';
        overlay.style.display = 'none';
    });



    // 削除用ボタン
    document.querySelectorAll('.delete_button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();  // デフォルトのフォーム送信を防止
            if (confirm('本当に削除しますか？')) {
                this.closest('form').submit();  // フォームを送信
            }
        });
    });
});

// プロフィール編集の画像挿入ボタン
document.getElementById('image').addEventListener('change', function () {
    var fileNameDiv = document.getElementById('fileName');
    if (this.files.length > 0) {
        var fileName = this.files[0].name;
        fileNameDiv.textContent = fileName; // ファイル名を設定
        fileNameDiv.style.display = 'block'; // ファイル名を表示
    } else {
        fileNameDiv.style.display = 'none'; // ファイルが選択されていない場合は非表示
    }
});

// テキストエリアの幅を自動で調整
document.addEventListener('DOMContentLoaded', function () {
    var textarea = document.querySelector('textarea');
    textarea.addEventListener('input', autoResize, false);

    function autoResize() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    }
});
