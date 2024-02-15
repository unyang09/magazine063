const express = require('express');
const app = express();

const maria = require('./database/connect/maria');
maria.connect();

app.use(express.static(__dirname+'/assets'))
app.use(express.static(__dirname+'/images'))
app.use(express.static(__dirname+'/fonts'))
app.use(express.static(__dirname+'/css'))
app.use(express.static(__dirname+'/pages'))
app.use(express.static(__dirname+'/turnjs4'))

app.use(express.urlencoded({ extended: true }));
 
app.set('view engine','ejs')

app.listen(8080,()=>{
  console.log('http://localhost:8080 에서 실행중')
})

app.get('/test', (req, res) => {

  res.render('test.ejs');

});

app.get('/', (req, res) => {

  maria.query('SELECT * FROM smile063', (error, results) => {
    if (error) {
      throw error;
    }
    res.render('smile063_index.ejs',{list : results});
  });

});

app.get('/magazine/:magazine_id', (req, res) => {

  const magazineId = req.params.magazine_id;

  maria.query('SELECT folder_path FROM smile063 where magazine_id=?',[magazineId],(error, results) => {
    
    if (error) {
      throw error;
    }

    const folderPath = results[0].folder_path;
    const rdf_folderPath = path.join("/Users/PC/Desktop/smile063/pages"+folderPath)

    fs.readdir(rdf_folderPath, (err, files) => {
      if (err) {
        console.error('Error reading directory:', err);
        return res.status(500).json({ error: 'Internal Server Error' });
      }
      const images = files.filter(file => /\.(png|jpg|jpeg|gif)$/i.test(file));
      res.render('magazine.ejs', { list: results, images: images, folderPath: folderPath, cnt: images.length });
    });

  }); 
}); 

// ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ  cms

app.get('/cms', (req, res) => {
  let data1, data2;

  maria.query('SELECT * FROM smile063 WHERE magazine_id < 7', (error, results) => {
    if (error) {
      throw error;
    }
    data1 = results;
  });

  maria.query('SELECT * FROM smile063 WHERE magazine_id > 6', (error, results) => {
    if (error) {
      throw error;
    }
    data2 = results;

    res.render('cms_index.ejs', { list1: data1, list2: data2 });
  });

});

const multer = require('multer');
const fs = require('fs');
const path = require('path');
 
// 파일 업로드를 위한 설정
const upload = multer({ dest: 'temp/' }); // 임시 디렉토리 설정

app.post('/upload', upload.array('images'), (req, res) => {
  const { foldername, title, sub_title1, sub_title2, sub_title3, sub_title4, sub_title_content1, sub_title_content2, sub_title_content3, sub_title_content4 } = req.body;
  const targetDir = path.join(__dirname, '/pages/', foldername);
  let firstImageFilename = ''; // 첫 번째 이미지 파일 이름 저장

  if (!fs.existsSync(targetDir)){
      fs.mkdirSync(targetDir, { recursive: true });
  }

  if(req.files && req.files.length > 0) {
      // 첫 번째 파일의 이름을 저장 (변경된 로직으로 인해 수정됨)
      firstImageFilename = '1'; // 첫 번째 이미지는 항상 "1"로 설정
      req.files.forEach((file, index) => {
          const extension = path.extname(file.originalname); // 원본 파일의 확장자 추출
          const newFilename = `${index + 1}${extension}`; // 새 파일 이름에 확장자 추가
          const destPath = path.join(targetDir, newFilename); // 원본 파일 이름 대신 newFilename 사용
          fs.renameSync(file.path, destPath);
          if(index === 0) { // 첫 번째 이미지의 경로를 저장
              firstImageFilename = newFilename;
          } 
      });
  }
 
  // 데이터베이스에 정보 저장, image_filename 컬럼 추가
  const insertQuery = 'INSERT INTO smile063 (title, sub_title1, sub_title2, sub_title3, sub_title4, sub_title_content1, sub_title_content2, sub_title_content3, sub_title_content4, folder_path, thumbnail, reg_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  const targetDir2 = path.join('/'+foldername);
  const regTime = new Date().toISOString();
  maria.query(insertQuery, [title, sub_title1, sub_title2, sub_title3, sub_title4, sub_title_content1, sub_title_content2, sub_title_content3, sub_title_content4, targetDir2, foldername+ "/" +firstImageFilename,regTime], (error, results) => {
      if (error) {
          console.error("데이터베이스 입력 오류:", error);
          res.status(500).send("데이터베이스 처리 중 오류 발생");
          return;
      } 
      res.redirect('/cms');
  });
});