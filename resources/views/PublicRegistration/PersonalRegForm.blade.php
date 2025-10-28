<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/fontawesome-free-7.0.1-web/css/all.min.css')}}" />
 <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}" /> -->
<link rel="icon"  type="image/x-icon" href="{{asset('header_footer/logo1.ico')}}" />
    <link rel="stylesheet" href="{{asset('css/publicGroupReg.css')}}" />
 <title>مسابقات الرمايه السنويه الرابع عشر - 2026</title>    
  <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Dancing+Script:wght@700&family=Lobster&family=Noto+Naskh+Arabic:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">

</head>


<body>
    
     <header class="header-two">
                  {{-- Success Message --}}
        @if(session('success'))
        <!--<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>-->
        @endif
      <div class="header-top">
        <div class="content">
          <div class="left-header-top">
            <div class="d-flex align-items-center gap-3">
              <img class="w-logo" src="{{asset('header_footer/logo1.png')}}" alt="logo" />
        <h1 class="title text-brown fw-bold">
        مسابقات الرماية السنوية - 2026
من 1/11/2025 الى 1/2/2026
              </h1>
            </div>
          </div>
          <div class="right-header-top">
            <div class="working-time">
              <ul class="social">
                <li>
                  <a href="https://www.snapchat.com/@rmaya.ae" class="social-item" target="_blank">
                    <i class="fab fa-snapchat"></i>
                  </a>
                </li>
                <li>
                  <a href="https://www.instagram.com/rmaya.ae/" class="social-item" target="_blank">
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
                <li>
                  <a href="https://x.com/rmayafestival" class="social-item" target="_blank">
                    <i class="fab fa-x"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
    <section class="breadcrumb-area bg_image tmp-section-gap breadcrumb-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-inner text-center">
              <h1 class="title split-collab">
            <h3 class="form-title fw-bold text-center">التسجيل الفردي في المسابقات </h3>
                <span class="circle"></span>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
    

    
    <main>
        <div class="container  bg-form p-3 rounded-3 pers">
             @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show " role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if ($errors->any())
    <!--<div class="alert alert-danger">-->
    <!--    <ul>-->
    <!--        @foreach ($errors->all() as $error)-->
    <!--        <li>{{ $error }}</li>-->
    <!--        @endforeach-->
    <!--    </ul>-->
    <!--</div>-->
    @endif
            <form action="{{route('store-public-personal-registration')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row  p-3">
                    <!--رقم البطاقة-->
                    <div class="col-md-6  my-2xxx">
                        <div class="p-1 ">
                            <div class="mb-1">
                                <label for="id-num" class="mb-2">رقم الهوية</label>
                                <input type="text" id="id-num" name="ID"  value="{{old('ID')}}"  class="form-control "
                                    inputmode="numeric" minlength="15" maxlength="15" required>
                                @error('ID')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--تاريخ-->
                    <div class="col-md-6   my-2xxx">
                        <div class="p-1">
                            <div class="mb-1">
                                <label for="id-date" class=" mb-2">تاريخ انتهاء الهوية</label>
                                <input type="date" id="id-date" lang="en"  value="{{old('Id_expire_date')}}" class="form-control "
                                    placeholder="mm/dd/yyyy" name="Id_expire_date" required>
                                @error('Id_expire_date')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--الاسم بالكامل-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <label for="name" class="mb-2"> الاسم بالكامل </label>
                                <input type="text" id="name" value="{{old('name')}}"  class="form-control " name='name' required>
                                @error('name')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--تاريخ-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <label for="dateofBirth" class="mb-2">تاريخ الميلاد </label>
                                <input type="date" id="birth-date"  lang="en" value="{{old('dob')}}"  class="form-control "
                                    placeholder="mm/dd/yyyy" name="dob" required>
                                @error('dob')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--الجنسية-->
                    <div class="col-md-6">
                        <label for="nat" class="mb-2">الجنسية</label>
                        <select name="nat" id="nat" class="form-select form-select-lg" required>
                            {{-- Placeholder --}}
                            <option value="" disabled {{ old('nat') ? '' : 'selected' }}>اختر الجنسية</option>

                            {{-- Default UAE --}}
                            <option value="222" {{ old('nat', 222) == 222 ? 'selected' : '' }}>الامارات العربية المتحدة</option>

                            {{-- Other countries --}}
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('nat') == $country->id ? 'selected' : '' }}>
                                {{ $country?->country_name_ar ?: $country->country_name }}
                            </option>
                            @endforeach
                        </select>
                        
        

                        @error('nat')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!--النوع و العمر-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="row mb-1 d-flex align-items-center mt-4">
                                <div class="col-md-6">
                                    <div>
                                        <div
                                            class="d-flex align-items-center gap-3 gender-margin">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                <label class="form-check-label " for="male">
                                                    ذكر
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="female">
                                                    انثي
                                                </label>
                                            </div>
                                            @error('gender')
                                            <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <input type="text" class="form-control " id="age" placeholder="العمر"
                                            readonly value="{{ old('age') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--النادي-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <select class="form-select" id="club_id" name="club_id">
                                    <option value="" disabled {{ old('club_id') ? '' : 'selected' }}>اختر النادي
                                    </option>
                                    @foreach($clubs as $club)
                                    <option value="{{ $club->cid }}"
                                        {{ old('club_id') == $club->cid ? 'selected' : '' }}>
                                        {{ $club->name }}
                                    </option>
                                    @endforeach

                                </select>
                                @error('club_id')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--السلاح-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <select class="form-select" id="weapon_id" name="weapon_id">
                                    <option value="" disabled selected>اختر النادي أولاً</option>
                                </select>
                                @error('weapon_id')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--الهاتف 1-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <label for="phone-num-one" class="  mb-2">رقم الهاتف 1</label>
                                <input type="text" id="phone-num-one"  value="{{old('phone1')}}"  class="form-control "
                                    placeholder="05xxxxxxx" name="phone1">
                                @error('phone1')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--الهاتف 2-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <label for="phone-num-two" class="  mb-2">رقم الهاتف 2</label>
                                <input type="text" id="phone-num-two"  value="{{old('phone2')}}"  class="form-control"
                                    placeholder="05xxxxxxx" name="phone2">
                                @error('phone2')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--رفع صوره بطاقه اماميه-->

                    <div class="col-md-6 my-2">
                        <div class="p-1">
                            <label class=" mb-2">رفع صوره البطاقه الامامية</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text  text-white bg-brown" for="photofront"><i
                                        class="fa-solid fa-upload"></i></label>
                                <input type="file" class="form-control" id="photofront" name="front_id_pic"
                                    accept=".jpg, .jpeg, .png">
                                @error('front_id_pic')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--رفع صوره بطاقه خلفية-->

                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <label class=" mb-2">رفع صوره البطاقه خلفية</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text  text-white bg-brown" for="photoBack"><i
                                        class="fa-solid fa-upload"></i></label>
                                <input type="file" class="form-control" id="photoBack" name="back_id_pic"
                                    accept=".jpg, .jpeg, .png">
                                @error('back_id_pic')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!--تسجيل-->
                    <div class="col-12 d-flex justify-content-center  align-items-center mt-3">
                        <button type="submit" class="btn btn-brown w-20 fw-bold ">تسجيل</button>
                    </div>


                </div>
            </form>
        </div>

    </main>
<footer class="footer">
  <div class="container d-flex justify-content-between align-items-center">
    <div class="text-start">
      <a href="https://esmart-vision.com" target="_blank">
        <img src="https://rmaya.ae/sys26/public/header_footer/foter-logo-co.png" alt="">
      </a><span class="me-2">Powered By</span>
    </div>
    <div class="d-flex align-items-center text-end">
   © 2017 <span id="year"></span>
           جميع الحقوق محفوظة مسابقات الرماية
         <script>
                              window.onload = function() {
                                var yearSpan = document.getElementById("year");
                                var currentYear = new Date().getFullYear();
                                if (currentYear > 2017) {
                                  yearSpan.textContent = " - " + currentYear;
                                }
                              }
                            </script>    </div>
  </div>
</footer>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- ajax backend query -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clubSelect = document.getElementById('club_id');
        const weaponSelect = document.getElementById('weapon_id');
        const dobInput = document.getElementById('birth-date');
        const genderInputs = document.querySelectorAll('input[name="gender"]');
        const ageInput = document.getElementById('age');

        function loadWeapons() {
            const clubId = clubSelect.value;
            const dob = dobInput.value;
            const gender = [...genderInputs].find(input => input.checked)?.value;

            if (clubId && dob && gender) {
                weaponSelect.innerHTML = '<option value="" disabled selected>جاري التحميل...</option>';
        const baseUrl = `https://rmaya.ae/sys26/public/clubs`;
        const fetchUrl = `${baseUrl}/${clubId}/weapons-by-age?dob=${dob}&gender=${gender}`;

                fetch(`{{ url('/clubs/${clubId}/weapons-by-age')}}?dob=${dob}&gender=${gender}`)
               // fetch(fetchUrl)
                
                    .then(response => response.json())
                    .then(data => {
                        weaponSelect.innerHTML = '<option value="" disabled selected>اختر السلاح</option>';
                        data.weapons.forEach(weapon => {
                            const option = document.createElement('option');
                            option.value = weapon.wid;
                            option.textContent = weapon.name;
                            weaponSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        weaponSelect.innerHTML =
                            '<option value="" disabled selected>حدث خطأ في التحميل</option>';
                    });
            } else {
                weaponSelect.innerHTML = '<option value="" disabled selected>اختر النادي أولاً</option>';
            }
        }

        // Events
        clubSelect.addEventListener('change', loadWeapons);
        dobInput.addEventListener('change', loadWeapons);
        genderInputs.forEach(input => input.addEventListener('change', loadWeapons));

        // حساب العمر عند اختيار تاريخ الميلاد
        dobInput.addEventListener('change', function() {
            const dob = this.value;
            if (dob) {
                const baseUrl2 = `https://rmaya.ae/sys26/public/calculate-age`;
                const fetchUrl2 = `${baseUrl2}?dob=${dob}`;
                //alert(fetchUrl2);
                fetch(fetchUrl2)
               // fetch(`{{ url(LaravelLocalization::getCurrentLocale().'/admin/calculate-age') }}?dob=${dob}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.age !== null) {
                            ageInput.value = data.age;
                        } else {
                            ageInput.value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        ageInput.value = '';
                    });
            } else {
                ageInput.value = '';
            }
        });
    });
</script>
<!-- UI form validation-->
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const nationalID = document.getElementById('id-num');
        nationalID.addEventListener('input', e => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 15) value = value.slice(0, 15);
            e.target.value = value;
        });


        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate() + 1).padStart(2, '0');
        const minDate = `${year}-${month}-${day}`;
        document.getElementById('id-date').setAttribute('min', minDate);


        const dobInput = document.getElementById('birth-date');
        const todayStr = new Date().toISOString().split('T')[0];
        dobInput.setAttribute('max', todayStr);


        function setupPhoneValidation(id) {
            const phoneInput = document.getElementById(id);
            phoneInput.addEventListener('input', e => {
                let value = e.target.value.replace(/\D/g, '');

                if (!value.startsWith('05')) {
                    value = '05' + value.replace(/^0+/, '');
                }

                if (value.length > 10) value = value.slice(0, 10);
                e.target.value = value;
            });

            phoneInput.addEventListener('paste', e => e.preventDefault());
        }
        setupPhoneValidation('phone-num-one');
        setupPhoneValidation('phone-num-two');


        const nameInput = document.getElementById('name');
        nameInput.addEventListener('input', e => {
            let value = e.target.value.normalize('NFC');
            value = value.replace(/[^\u0600-\u06FF\s]/g, '');
            e.target.value = value;
        });
    });
</script>



  
<script type='text/javascript' src='https://smartv-demo.com/reham/club-3/assets/js/jquery-3.6.0.min.js'></script>
  <script>
    /*---====================---select---======================---*/ 
   $(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});
$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});
$(".custom-select-trigger").on("click", function() {
  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();
});
$(".custom-option").on("click", function() {
  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value"));
  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
}); 
</script>


