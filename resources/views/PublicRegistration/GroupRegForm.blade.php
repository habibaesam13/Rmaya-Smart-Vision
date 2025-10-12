<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/fontawesome-free-7.0.1-web/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/publicGroupReg.css')}}" />
  <title>مسابقات الرمايه السنوية</title>
</head>

<body>
  <nav class="d-flex justify-content-between align-items-center bg-baige px-5 py-2">
    <div class="d-flex align-items-center gap-3">
      <img class="w-logo" src="{{asset('header_footer/logo1.png')}}" alt="logo" />
      <h1 class="title text-brown fw-bold">ميادين الريف للرماية 2025
        <br>
        <span class="date-size">من 03/ 12 / 2024 الى 14/ 02 / 2025</span>
      </h1>
    </div>

    <i class="fa-solid fa-globe fa-xl color-icon"></i>
  </nav>
  <main>
    <div class="container bg-form p-3 rounded-3">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="form-title text-brown fw-bold text-center background-skewed">تسجيل فرق اسقاط صحون</h3>
      </div>
      <form action="">
        <div class="my-2 w-75 mx-auto">
          <input type="text" placeholder="أسم الفريق" class="form-control w-100">
        </div>
        <div class="row mt-3 ">
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                الفئة الأولى بندقية فرق رجال - 60 عام فما فوق
              </label>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
              <label class="form-check-label" for="flexRadioDefault2">
                الفئة الثانية بندقية فرق رجال - 50 الى 59 </label>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
              <label class="form-check-label" for="flexRadioDefault3">
                الفئة الثانية بندقية فرق رجال - 40 الى 49
              </label>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4">
              <label class="form-check-label" for="flexRadioDefault4">
                الفئة الرابعة بندقية فرق رجال -39 فما دون
              </label>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault5">
              <label class="form-check-label" for="flexRadioDefault5">
                مسدس فرق رجال
              </label>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault6">
              <label class="form-check-label" for="flexRadioDefault6">
                مسدس فرق نساء
              </label>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault7">
              <label class="form-check-label" for="flexRadioDefault7">
                سكتون فرق رجال
              </label>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault8">
              <label class="form-check-label" for="flexRadioDefault8">
                سكتون فرق نساء
              </label>
            </div>
          </div>
        </div>
        <div class="tabel-container">
          <table>
            <thead>
              <tr>
                <th style="min-width: 160px;">رقم الهوية</th>
                <th style="min-width: 160px;">تاريخ نهاية الهوية</th>
                <th style="min-width: 160px;">الاسم كاملا</th>
                <th style="min-width: 160px;">الهاتف</th>
                <th style="min-width: 160px;">تاريخ الميلاد</th>
                <th style="min-width: 80px;">العمر</th>
                <th style="min-width: 160px;">صورة الهوية امامى</th>
                <th style="min-width: 160px;">صورة الهوية خلفى</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="0000 000000 0000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="text" placeholder="الاسم">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="055 0000000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="00">
                </td>
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
              </tr>
              <tr>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="0000 000000 0000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="text" placeholder="الاسم">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="055 0000000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="00">
                </td>
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
              </tr>
              <tr>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="0000 000000 0000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="text" placeholder="الاسم">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="055 0000000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="00">
                </td>
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
              </tr>
              <tr>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="0000 000000 0000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="text" placeholder="الاسم">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="055 0000000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="00">
                </td>
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" name="" id="">
                </td>
               
              </tr>
              <tr class="last-row">
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="0000 000000 0000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="text" placeholder="الاسم">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="055 0000000">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="date" placeholder="mm/dd/yyyy">
                </td>
                <td>
                  <input class="form-control form-control-sm" type="number" placeholder="00">
                </td>
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" >
                </td>
               
                <td style="max-width: 160px; overflow:hidden;" class="px-1">
                  <input type="file" >
                </td>
               
              </tr>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </main>
   <footer class="bg-baige footer py-3">
    <div class="d-flex justify-content-around align-items-center px-5 ">
      <div class="text-brown  fw-800">
        copy&copy;rmaya.ae 2025
      </div>
      <div>
        <img src="{{asset('header_footer/foter-logo-co.png')}}" alt="">
      </div>
    </div>
  </footer>
  <script src="./js/demo.js"></script>
</body>

</html>