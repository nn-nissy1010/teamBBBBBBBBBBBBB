const file = document.getElementById('accountFile');
const fileName = document.getElementById('accountFileName');
file.addEventListener('change', (event) => {
  const files = event.target.files;
  const fileNames = [];
  if (files.length > 1) {
    fileName.textContent = '選択可能なファイル数は1つまでです。';
    return;
  }
  for (let i = 0; i < files.length; i++) {
    fileNames.push(files[i].name);
  }
  const fileNamesList = fileNames.join('\n');
  fileName.textContent = fileNamesList ? fileNamesList : '選択されていません';
});

function CheckPassword(confirm){
  // 入力値取得
  var input1 = password.value;
  var input2 = confirm.value;
  // パスワード比較
  if(input1 != input2){
    confirm.setCustomValidity("入力値が一致しません。");
  }else{
    confirm.setCustomValidity('');
  }
}