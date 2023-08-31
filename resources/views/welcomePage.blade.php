@extends('auth.components.authTemplate')

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-more" style="padding-top: 40px">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="/image/welcomeLogo.svg" alt="" srcset="">
                    </div>
                </div>

                <div class="d-flex align-content-center">
                    <div class="login100-form d-flex flex-column gap-5" style="justify-content: space-evenly">
                        <div class="d-flex mb-3 gap-5 flex-column">
                            <span style="font-size: 2pc; color: #5D4575; font-weight: bolder" class="mb-3">
                                Selamat datang di <span style="color: #957DAD">MusiCave</span>
                            </span>
                            <span style="color: #5D4575; font-weight: 500;" class="mb-3 fs-4 text">
                                Platform musik yang menghadirkan pengalaman mendengarkan tak terlupakan Di sini
                            </span>
                        </div>

                        <div class="d-flex gap-4 mb-4 flex-column" style="width: 80%">
                            <div>
                                <span style="color: #5D4575">
                                    Pilih peran anda
                                </span>
                            </div>
                            <div class="d-flex flex-row flex-wrap gap-3">
                                <div class="container-login100-form-btn" style="width: 40%">
                                    <button id="user_pengguna" class="selected login100-form-btn rounded-4"
                                        style="font-weight: bolder">
                                        <span>
                                            <svg class="mt-2 selected" width="38" height="30" viewBox="0 0 40 38"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path class="selected svg1"
                                                    d="M19.8634 17.4167C21.173 17.4167 22.4531 17.0452 23.5419 16.3493C24.6308 15.6534 25.4795 14.6643 25.9806 13.507C26.4817 12.3497 26.6129 11.0763 26.3574 9.84776C26.1019 8.61922 25.4713 7.49073 24.5453 6.60499C23.6193 5.71926 22.4395 5.11607 21.1551 4.8717C19.8707 4.62732 18.5394 4.75274 17.3296 5.2321C16.1197 5.71145 15.0856 6.52321 14.3581 7.56472C13.6305 8.60624 13.2422 9.83072 13.2422 11.0833C13.2422 12.763 13.9398 14.3739 15.1815 15.5617C16.4232 16.7494 18.1073 17.4167 19.8634 17.4167Z" />
                                                <path class="selected svg1"
                                                    d="M29.7953 33.2499C30.2343 33.2499 30.6554 33.0831 30.9658 32.7862C31.2762 32.4892 31.4506 32.0865 31.4506 31.6666C31.4506 28.7271 30.2298 25.908 28.0568 23.8295C25.8838 21.751 22.9366 20.5833 19.8635 20.5833C16.7904 20.5833 13.8432 21.751 11.6702 23.8295C9.49715 25.908 8.27637 28.7271 8.27637 31.6666C8.27637 32.0865 8.45077 32.4892 8.76119 32.7862C9.07162 33.0831 9.49266 33.2499 9.93167 33.2499H29.7953Z" />
                                            </svg>

                                        </span>
                                        Pengguna
                                    </button>
                                </div>
                                <div class="container-login100-form-btn" style="width: 40%">
                                    <button id="user_admin" class="login100-form-btn d-flex gap-2 rounded-4"
                                        style="font-weight: bolder">
                                        <span>
                                            <svg class="mt-2 selected" width="28" height="30" viewBox="0 0 28 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M26.2324 16.0402C26.3441 15.4344 26.3441 14.8156 26.2324 14.2098L27.341 13.5695C27.4699 13.4965 27.5258 13.3461 27.4828 13.2043C27.1949 12.2762 26.7008 11.434 26.0563 10.7379C25.9574 10.6305 25.7984 10.6047 25.6695 10.6777L24.5609 11.318C24.0926 10.9184 23.5555 10.609 22.9754 10.4027V9.12227C22.9754 8.97617 22.8723 8.84727 22.7305 8.81719C21.7723 8.60234 20.7969 8.61094 19.8859 8.81719C19.7441 8.84727 19.641 8.97617 19.641 9.12227V10.4027C19.0609 10.609 18.5238 10.9184 18.0555 11.318L16.9469 10.6777C16.8223 10.6047 16.659 10.6305 16.5602 10.7379C15.9156 11.434 15.4215 12.2762 15.1336 13.2043C15.0906 13.3461 15.1508 13.4965 15.2754 13.5695L16.384 14.2098C16.2723 14.8156 16.2723 15.4344 16.384 16.0402L15.2754 16.6805C15.1465 16.7535 15.0906 16.9039 15.1336 17.0457C15.4215 17.9738 15.9156 18.8117 16.5602 19.5121C16.659 19.6195 16.818 19.6453 16.9469 19.5723L18.0555 18.932C18.5238 19.3316 19.0609 19.641 19.641 19.8473V21.1277C19.641 21.2738 19.7441 21.4027 19.8859 21.4328C20.8441 21.6477 21.8195 21.6391 22.7305 21.4328C22.8723 21.4027 22.9754 21.2738 22.9754 21.1277V19.8473C23.5555 19.641 24.0926 19.3316 24.5609 18.932L25.6695 19.5723C25.7941 19.6453 25.9574 19.6195 26.0563 19.5121C26.7008 18.816 27.1949 17.9738 27.4828 17.0457C27.5258 16.9039 27.4656 16.7535 27.341 16.6805L26.2324 16.0402ZM21.3125 17.209C20.1609 17.209 19.2285 16.2723 19.2285 15.125C19.2285 13.9777 20.1652 13.041 21.3125 13.041C22.4598 13.041 23.3965 13.9777 23.3965 15.125C23.3965 16.2723 22.4641 17.209 21.3125 17.209ZM9.625 11C12.6629 11 15.125 8.53789 15.125 5.5C15.125 2.46211 12.6629 0 9.625 0C6.58711 0 4.125 2.46211 4.125 5.5C4.125 8.53789 6.58711 11 9.625 11ZM18.2703 20.7324C18.1715 20.6809 18.0727 20.6207 17.9781 20.5648L17.6387 20.7625C17.3809 20.9086 17.0887 20.9902 16.7965 20.9902C16.3281 20.9902 15.877 20.7926 15.5547 20.4488C14.7684 19.598 14.1668 18.5625 13.8273 17.4582C13.591 16.6977 13.909 15.8941 14.5965 15.4945L14.9359 15.2969C14.9316 15.1852 14.9316 15.0734 14.9359 14.9617L14.5965 14.7641C13.909 14.3688 13.591 13.5609 13.8273 12.8004C13.866 12.6758 13.9219 12.5512 13.9648 12.4266C13.8016 12.4137 13.6426 12.375 13.475 12.375H12.7574C11.8035 12.8133 10.7422 13.0625 9.625 13.0625C8.50781 13.0625 7.45078 12.8133 6.49258 12.375H5.775C2.58672 12.375 0 14.9617 0 18.15V19.9375C0 21.0762 0.923828 22 2.0625 22H17.1875C17.6215 22 18.0254 21.8625 18.3563 21.6348C18.3047 21.4715 18.2703 21.3039 18.2703 21.1277V20.7324Z"
                                                    fill="#957DAD" />
                                            </svg>

                                        </span>
                                        artis
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const pengguna = document.querySelector('#user_pengguna')
        const admin = document.querySelector('#user_admin')

        pengguna.addEventListener('click', () => {
            window.location = '{{ route('pengguna') }}';
        })

        admin.addEventListener('click', () => {
            window.location = '{{ route('pengguna') }}';
        })
    </script>
@endsection
