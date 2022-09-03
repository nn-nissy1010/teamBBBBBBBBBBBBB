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