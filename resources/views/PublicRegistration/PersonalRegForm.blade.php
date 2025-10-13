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
        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
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
            <form action="{{route('store-public-personal-registration')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row  p-3">
                    <!--رقم البطاقة-->
                    <div class="col-md-6   my-2">
                        <div class="p-1 ">
                            <div class="mb-1">
                                <label for="id-num" class=" text-white mb-2">رقم البطاقه</label>
                                <input type="text" id="id-num" name="ID" class="form-control text-center"
                                    inputmode="numeric" maxlength="15" required>
                                @error('ID')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> 
                    <!--تاريخ-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <label for="id-date" class=" text-white mb-2">تاريخ انتهاء الهوية</label>
                                <input type="date" id="id-date" class="form-control text-center"
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
                                <label for="name" class=" text-white mb-2"> الاسم بالكامل </label>
                                <input type="text" id="name" class="form-control text-center" name='name' required>
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
                                <label for="dateofBirth" class=" text-white mb-2">تاريخ الميلاد </label>
                                <input type="date" id="birth-date" class="form-control text-center"
                                    placeholder="mm/dd/yyyy" name="dob" required>
                                @error('dob')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--الجنسية-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="mb-1">
                                <select class="form-select" id="floatingSelect" name="nat" required>
                                    <option value="" disabled {{ old('nat') ? '' : 'selected' }}>اختر الجنسية</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('nat') == $country->id ? 'selected' : '' }}>
                                        {{ $country?->country_name_ar ?: $country->country_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('nat')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--النوع و العمر-->
                    <div class="col-md-6   my-2">
                        <div class="p-1">
                            <div class="row mb-1 d-flex align-items-center">
                                <div class="col-md-6">
                                    <div>
                                        <div
                                            class="d-flex justify-content-center align-items-center gap-3 gender-margin">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male"
                                                    value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                                <label class="form-check-label text-light " for="male">
                                                    ذكر
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                                <label class="form-check-label text-light " for="female">
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
                                        <input type="text" class="form-control text-center" id="age" placeholder="العمر"
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
                                <label for="phone-num-one" class=" text-white mb-2">رقم الهاتف 1</label>
                                <input type="text" id="phone-num-one" class="form-control text-center"
                                    placeholder="055xxxxxxx" name="phone1">
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
                                <label for="phone-num-two" class=" text-white mb-2">رقم الهاتف 2</label>
                                <input type="text" id="phone-num-two" class="form-control text-center"
                                    placeholder="055xxxxxxx" name="phone2">
                                @error('phone2')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
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
                                <input type="file" class="form-control rounded-2" id="photofront" name="front_id_pic"
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
                            <label class=" text-white mb-2">رفع صوره البطاقه خلفية</label>
                            <div class="input-group mb-3">
                                <label class="input-group-text rounded-2 text-white bg-brown" for="photoBack"><i
                                        class="fa-solid fa-upload fa-2xl"></i></label>
                                <input type="file" class="form-control rounded-2" id="photoBack" name="back_id_pic"
                                    accept=".jpg, .jpeg, .png">
                                @error('back_id_pic')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
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

                fetch(`/admin/clubs/${clubId}/weapons-by-age?dob=${dob}&gender=${gender}`)
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
                fetch(`{{ route('calculate.age') }}?dob=${dob}`)
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

                if (!value.startsWith('055')) {
                    value = '055' + value.replace(/^0+/, '');
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