<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('fonts/fontawesome-free-7.0.1-web/css/all.min.css')}}" />
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
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
        <h3 class="form-title text-brown fw-bold text-center background-skewed">التسجيل الفردي في المسابقات</h3>
      </div>
      <form action="">
        <div class="row  p-3">
          <!--رقم البطاقة-->
          <div class="col-md-6   my-2">
            <div class="p-1 ">
              <div class="mb-1">
                <label for="id-num" class=" text-white mb-2">رقم البطاقه</label>
                <input type="text" id="id-num" class="form-control text-center">
              </div>
            </div>
          </div>
          <!--تاريخ-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <label for="id-date" class=" text-white mb-2">تاريخ انتهاء الهوية</label>
                <input type="date" id="id-date" class="form-control text-center" placeholder="mm/dd/yyyy">
              </div>
            </div>
          </div>
          <!--الاسم بالكامل-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <label for="name" class=" text-white mb-2"> الاسم بالكامل </label>
                <input type="text" id="name" class="form-control text-center">
              </div>
            </div>
          </div>
          <!--تاريخ-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <label for="dateofBirth" class=" text-white mb-2">تاريخ الميلاد </label>
                <input type="date" id="dateofBirth" class="form-control text-center" placeholder="mm/dd/yyyy">
              </div>
            </div>
          </div>
          <!--الجنسية-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <select class="form-select" id="floatingSelect">
                  <option selected>الجنسية</option>
                  <option value="باكستان">باكستان</option>
                  <option value="الامارات العربية المتحدة">الامارات العربية المتحدة</option>
                  <option value="الهند">الهند</option>
                  <option value="الاردن">الاردن</option>
                </select>
              </div>
            </div>
          </div>
          <!--النوع و العمر-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="row mb-1 d-flex align-items-center">
                <div class="col-md-6">
                  <div>
                    <div class="d-flex justify-content-center align-items-center gap-3 gender-margin">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male">
                        <label class="form-check-label text-light " for="male">
                          ذكر
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female">
                        <label class="form-check-label text-light " for="female">
                          انثي
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div>
                    <input type="number" class="form-control text-center" placeholder="العمر">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--النادي-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <select class="form-select" id="floatingSelect">
                  <option selected>اختر النادي</option>
                  <option value="نادي الريف">نادي الريف</option>
                  <option value="نادي مصفوفات"> نادي مصفوفات </option>
                  <option value="نادي الفجيرة">نادي الفجيرة</option>
                </select>
              </div>
            </div>
          </div>
          <!--السلاح-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <select class="form-select" id="floatingSelect">
                  <option selected>اختر السلاح</option>
                  <option value="بندقية فردي رجال">بندقية فردي رجال</option>
                  <option value="البندقية التراثيه فردي رجال">البندقية التراثيه فردي رجال</option>
                  <option value="المسدس رجال">المسدس رجال</option>
                  <option value="المسدس فردي نساء">المسدس فردي نساء</option>
                </select>
              </div>
            </div>
          </div>
          <!--الهاتف 1-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <label for="phone-num-one" class=" text-white mb-2">رقم الهاتف 1</label>
                <input type="text" id="phone-num-one" class="form-control text-center" placeholder="رقم الهاتف 1">
              </div>
            </div>
          </div>
          <!--الهاتف 2-->
          <div class="col-md-6   my-2">
            <div class="p-1">
              <div class="mb-1">
                <label for="phone-num-two" class=" text-white mb-2">رقم الهاتف 2</label>
                <input type="text" id="phone-num-two" class="form-control text-center" placeholder="رقم الهاتف 2">
              </div>
            </div>
          </div>
          <!--رفع صوره بطاقه اماميه-->

          <div class="col-md-6   my-2">
            <div class="p-1">
              <label class=" text-white mb-2">رفع صوره البطاقه الامامية</label>
              <div class="input-group mb-3">
                <label class="input-group-text rounded-2 text-white bg-brown" for="photofront"><i
                    class="fa-solid fa-upload fa-2xl"></i></label>
                <input type="file" class="form-control rounded-2" id="photofront" placeholder="ghada">
              </div>
            </div>
          </div>
           <!--رفع صوره بطاقه خلفية-->

          <div class="col-md-6   my-2">
            <div class="p-1">
              <label class=" text-white mb-2">رفع صوره البطاقه خلفية</label>
              <div class="input-group mb-3">
                <label class="input-group-text rounded-2 text-white bg-brown" for="photoBack"><i
                    class="fa-solid fa-upload fa-2xl"></i></label>
                <input type="file" class="form-control rounded-2" id="photoBack" placeholder="ghada">
              </div>
            </div>
          </div>

          <!--تسجيل-->
          <div class="col-12 d-flex justify-content-center align-items-center mt-3">
            <button type="submit" class="btn btn-brown w-50 fw-bold ">تسجيل</button>
          </div>


        </div>
      </form>
    </div>

  </main>
  <footer class="bg-baige footer py-3">
    <div class="d-flex justify-content-around align-items-center px-5 ">
      <div class="text-brown  fw-800">
        copy&copy; smart vision it solutions 2025
      </div>
      <div>
        <img src="{{asset('header_footer/foter-logo-co.png')}}" alt="">
      </div>
    </div>
  </footer>
</body>

</html>