@extends('user.layout.index')

@section('style')
    <style>
        .card-profile {
            width: 100%;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header-custom {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            background: rgba(255, 140, 0, 0.05);
        }

        .card-header-custom span {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary);
            font-size: 0.9rem;
        }

        .profile-forms {
            padding: 30px;
        }

        .input-group-custom {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .input-group-custom label {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .input-group-custom input {
            height: 45px;
            padding: 0px 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: #fff;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group-custom input:focus {
            border-color: var(--primary);
            background: rgba(255, 140, 0, 0.1);
        }

        .input-group-custom input[readonly] {
            cursor: default;
            opacity: 0.7;
        }

        .btn-profile-action {
            padding: 10px 20px;
            background: var(--primary);
            border: none;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-profile-action:hover {
            background-color: var(--primary-dark);
        }

        .btn-profile-action.mode-edit {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
        }

        .btn-profile-action.mode-edit:hover {
            background: rgba(255, 140, 0, 0.1);
        }

        .avatar-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 30px;
            cursor: pointer;
        }

        .avatar-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--primary);
            background: var(--glass);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-preview i {
            font-size: 80px;
            color: var(--primary);
            opacity: 0.5;
        }

        .avatar-upload-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .avatar-wrapper:hover .avatar-upload-overlay {
            opacity: 1;
        }

        .avatar-upload-overlay i {
            color: #fff;
            font-size: 24px;
        }

        #inputAvatar {
            display: none;
        }
    </style>
@endsection

@section('container')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Profil Saya</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Kelola informasi akun Anda</li>
        </ol>

        <div class="row">
            <div class="col-xl-6">
                <div class="card-profile mb-4">
                    <div class="card-header-custom">
                        <span><i class="fas fa-user-circle me-2"></i> Informasi Dasar</span>
                    </div>
                    <div class="profile-forms">
                        <form action="{{ url('/profileuser') }}" method="POST" id="profileForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="avatar-wrapper" id="avatarTrigger">
                                <div class="avatar-preview">
                                    @if ($user->avatar)
                                        <img src="{{ asset('storage/avatar/' . $user->avatar) }}" alt="Profile"
                                            id="previewImage">
                                    @else
                                        <i class="fas fa-user-circle" id="previewIcon"></i>
                                        <img src="" alt="Profile" id="previewImage" class="d-none">
                                    @endif
                                </div>
                                <div class="avatar-upload-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                                <input type="file" name="avatar" id="inputAvatar" accept="image/*" disabled>
                            </div>

                            <div class="input-group-custom">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $user->name }}" readonly id="inputName">
                            </div>

                            <div class="input-group-custom">
                                <label>Alamat Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" readonly id="inputEmail">
                            </div>

                            <button type="button" id="toggleButton" class="btn-profile-action mode-edit">
                                <i class="fas fa-edit mr-2"></i> Edit Profil
                            </button>

                            <button type="submit" id="saveButton" class="btn-profile-action mt-3 d-none">
                                <i class="fas fa-save mr-2"></i> Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const toggleButton = document.getElementById('toggleButton');
        const saveButton = document.getElementById('saveButton');
        const inputAvatar = document.getElementById('inputAvatar');
        const avatarTrigger = document.getElementById('avatarTrigger');
        const previewImage = document.getElementById('previewImage');
        const previewIcon = document.getElementById('previewIcon');
        const inputs = [document.getElementById('inputName'), document.getElementById('inputEmail')];

        toggleButton.addEventListener('click', function() {
            // Aktifkan input
            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.style.border = "1px solid var(--primary)";
            });

            // Aktifkan avatar input
            inputAvatar.disabled = false;

            // Sembunyikan tombol edit, tampilkan tombol save
            toggleButton.classList.add('d-none');
            saveButton.classList.remove('d-none');

            // Fokus ke input pertama
            inputs[0].focus();
        });

        avatarTrigger.addEventListener('click', function() {
            if (!inputAvatar.disabled) {
                inputAvatar.click();
            }
        });

        inputAvatar.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('d-none');
                    if (previewIcon) {
                        previewIcon.classList.add('d-none');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
