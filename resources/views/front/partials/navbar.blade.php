 <!-- Start Top Nav -->

 <!-- Close Top Nav -->

 <style>
     .ftco-navbar-light {
         background: transparent !important;
         top: 0;
         transition: all 0.3s ease;
         box-shadow: none;
         padding: 20px 0;
     }

     .ftco-navbar-light.scrolled {
         top: 0;
         background: #101010 !important;
         /* Surface Card Color */
         backdrop-filter: blur(15px);
         border-bottom: 1px solid rgba(255, 255, 255, 0.05);
         box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
         padding: 10px 0;
         z-index: 1000 !important;
     }

     .ftco-navbar-light {
         z-index: 1000 !important;
     }

     .ftco-navbar-light.awake {
         margin-top: 0px;
         transition: .3s all ease-out;
     }

     .ftco-navbar-light.sleep {
         transition: .3s all ease-out;
         opacity: 1;
         /* Prevent disappearing */
         transform: translateY(0);
         /* Prevent disappearing */
     }

     .navbar-brand {
         font-family: 'Outfit', sans-serif;
         font-weight: 900;
         font-size: 24px !important;
         text-transform: uppercase;
         letter-spacing: -1px;
         background: #FF8C00;
         -webkit-background-clip: text;
         -webkit-text-fill-color: transparent;
     }

     .nav-link {
         font-family: 'Outfit', sans-serif;
         font-weight: 600 !important;
         text-transform: uppercase;
         letter-spacing: 1px;
         font-size: 13px !important;
         position: relative;
         padding: 10px 20px !important;
         color: #ffffff !important;
     }

     .ftco-navbar-light.scrolled .nav-link {
         color: #ffffff !important;
     }

     .nav-link::after {
         content: '';
         position: absolute;
         bottom: 0;
         left: 50%;
         width: 0;
         height: 2px;
         background: #FF8C00;
         transition: all 0.3s ease;
         transform: translateX(-50%);
     }

     .nav-link:hover::after,
     .nav-item.active .nav-link::after {
         width: 20px;
     }

     .nav-item.cta .nav-link {
         background: #FF8C00 !important;
         border-radius: 50px;
         padding: 8px 25px !important;
         color: white !important;
         box-shadow: 0 10px 20px rgba(255, 140, 0, 0.2);
         margin-left: 10px;
     }

     .nav-item.cta .nav-link::after {
         display: none;
     }

     .navbar-toggler {
         border: none !important;
         color: #ffffff !important;
         font-family: 'Outfit', sans-serif;
         font-weight: 700;
         text-transform: uppercase;
         font-size: 14px;
     }

     .ftco-navbar-light.scrolled .navbar-toggler {
         color: #ffffff !important;
     }

     @media (max-width: 991.98px) {
         .navbar-collapse {
             background: #101010;
             padding: 15px;
             border-radius: 12px;
             margin-top: 10px;
             border: 1px solid rgba(255, 255, 255, 0.1);
             box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
         }

         .nav-item {
             margin-bottom: 5px;
         }

         .nav-link {
             padding: 10px 0 !important;
             display: block;
         }

         .nav-item.active .nav-link,
         .nav-link:hover {
             color: #FF8C00 !important;
             padding-left: 10px !important;
         }

         .nav-link::after {
             display: none;
             /* Hide underline on mobile, use color change/indent instead */
         }
     }

     .dropdown-item {
         transition: all 0.3s ease;
     }

     .dropdown-item:hover {
         background-color: rgba(255, 140, 0, 0.1) !important;
         color: #FF8C00 !important;
         padding-left: 1.5rem !important;
     }

     .dropdown-item i {
         width: 25px;
         text-align: center;
     }

     .btn-dashboard {
         background: rgba(255, 255, 255, 0.1);
         border: 1px solid rgba(255, 255, 255, 0.2);
         color: #fff !important;
         padding: 8px 20px !important;
         border-radius: 50px;
         display: flex;
         align-items: center;
         gap: 8px;
         transition: all 0.3s;
         text-transform: uppercase;
         font-size: 12px !important;
         letter-spacing: 1px;
         height: 38px;
         /* Fixed height to prevent resizing */
         width: max-content;
         /* Ensure width adapts but doesn't jump */
         margin-top: 0 !important;
         /* Override potential margins */
     }

     .btn-dashboard:hover {
         background: var(--primary);
         border-color: var(--primary);
         transform: translateY(-2px);
     }
 </style>

 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light scrolled" id="ftco-navbar">
     <div class="container">
         <a class="navbar-brand" href="/">Mumu<span>Kitchen</span></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
             aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
             <i class="fas fa-bars mr-1"></i> MENU
         </button>

         <div class="collapse navbar-collapse" id="ftco-nav">
             <ul class="navbar-nav ml-auto">
                 <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a href="/"
                         class="nav-link">Beranda</a></li>
                 <li
                     class="nav-item {{ Request::is('produk*') || Request::is('kategorikatalog*') || Request::is('produkdetail*') ? 'active' : '' }}">
                     <a href="/produk" class="nav-link">Menu Katering</a>
                 </li>
                 <li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}"><a href="/contact"
                         class="nav-link">Kontak</a></li>

                 @auth
                     <li class="nav-item">
                         @if (auth()->user()->is_admin == 1)
                             <a href="/dashboard" class="nav-link btn-dashboard ml-lg-3">
                                 <i class="fas fa-th-large"></i> DASHBOARD
                             </a>
                         @else
                             <a href="/riwayat" class="nav-link btn-dashboard ml-lg-3">
                                 @if (auth()->user()->avatar)
                                     <img src="{{ asset('storage/avatar/' . auth()->user()->avatar) }}" alt="Avatar"
                                         class="rounded-circle mr-2" style="width: 24px; height: 24px; object-fit: cover;">
                                 @else
                                     <i class="fas fa-user-circle"></i>
                                 @endif
                                 AKUN SAYA
                             </a>
                         @endif
                     </li>
                 @else
                     <li class="nav-item"><a href="/login" class="nav-link">Masuk</a></li>
                 @endauth

                 <li class="nav-item cta">
                     <a href="/keranjang" class="nav-link">
                         <i class="fas fa-shopping-basket mr-1"></i>
                         [<span id="cart-count">{{ $keranjangs->unique('produk_id')->count() }}</span>]
                     </a>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
 <!-- END nav -->
 <!-- Close Header -->
