const file = document.getElementById('roomFile');
const fileName = document.getElementById('roomFileName');
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
//.validationForm を指定した最初の form 要素を取得
const validationForm = document.querySelector('.validation-form');
//required クラスを指定された要素の集まり  
const requiredElems = document.querySelectorAll('.required');
 
//送信時の処理
validationForm.addEventListener('submit', (e) => {
  //エラー表示の初期化（一度全てのエラーを削除）
  const errorElems = e.currentTarget.querySelectorAll('.error');
  errorElems.forEach( (elem) => {
    elem.remove(); 
  });
 
  //.required を指定した要素を検証
  requiredElems.forEach( (elem) => {
    //ラジオボタンの場合
    if(elem.tagName === 'INPUT' && elem.getAttribute('type') === 'radio') {
      //選択状態の最初のラジオボタン要素を取得
      const checkedRadio = elem.parentElement.querySelector('input[type="radio"]:checked');
      //選択状態のラジオボタン要素を取得できない場合
      if(checkedRadio === null) {
        createError(elem, 'いずれか1つを選択してください');
        e.preventDefault();
      }  
    }else if(elem.tagName === 'INPUT' && elem.getAttribute('type') === 'checkbox') {
      //選択状態の最初のチェックボックス要素を取得
      const checkedCheckbox = elem.parentElement.querySelector('input[type="checkbox"]:checked');
      //選択状態のチェックボックス要素を取得できない場合
      if(checkedCheckbox === null) {
        createError(elem, '少なくとも1つを選択してください');
        e.preventDefault();
      } 
    }else{
      const elemValue = elem.value.trim(); 
      //値が空の場合はエラーを表示してフォームの送信を中止
      if(elemValue.length === 0) {
        if(elem.tagName === 'SELECT') {
          createError(elem, '選択してください');
        }else{
          createError(elem, '入力は必須です');
        } 
        e.preventDefault();
      } 
    }  
  });
}); 
  
//エラーメッセージを表示する span 要素を生成して親要素に追加する関数
// const createError = (elem, errorMessage) => {
//   const errorSpan = document.createElement('span');
//   errorSpan.classList.add('error');
//   errorSpan.setAttribute('aria-live', 'polite');
//   errorSpan.textContent = errorMessage;
//   elem.parentNode.appendChild(errorSpan);
// }