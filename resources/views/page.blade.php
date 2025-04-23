@extends('layouts.template')

@section('styles')
    <style>
        /* Base Styles */
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        /* FOOTER FIX */
        .footer {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        .footer p {
            color: black;
            font-size: 15px;
            font-weight: 400;
            margin: 0;
        }

        /* Hero Section */
        .hero {
            padding: 120px 0 80px;
            position: relative;
            margin-top: 30px;
        }

        .hero .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-content {
            max-width: 50%;
        }

        .hero-content h1 {
            font-family: var(--brand-font);
            font-size: 80px;
            color: #4F5153;
            margin-bottom: 20px;
            line-height: 1;
        }

        .hero-content h2 {
            font-size: 35px;
            color: #6C4F51;
            margin-bottom: 20px;
            line-height: 1.4;
            font-weight: 700;
        }

        .btn-getstartedOK {
    background-color: transparent;
    color: var(--nav-color);
    padding: 8px 20px;
    text-decoration: none;
    font-weight: 500;
    font-size: 20px;
    transition: all 0.3s;
  }

  .btn-getstartedOK:hover {
    font-weight: bolder;
    color: var(--nav-hover-color);
    transform: translateY(-2px);
  }

        .hero-buttons .btn-primary {
            background-color: #8F7059;
            color: white;
            padding: 12px 30px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 700;
            display: inline-block;
            margin-top: 20px;
            border: 4px solid #4D403A;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            font-size: 20px;
            transition: all 0.3s;
        }

        .hero-buttons .btn-primary:hover {
            background-color: #7a5f4b;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .hero-image img {
            margin-top: 1px;
            margin-right: 0.3%;
            max-width: 100%;
            height: auto;
            max-height: 600px;
        }

        /* Features Section */
        .features-section {
            background-color: #4D403A;
            padding: 80px 20px;
            border-radius: 30px;
            margin: 40px auto;
            max-width: 1310px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        .features-container {
            display: flex;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
            flex-wrap: wrap;
            gap: 30px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            max-width: 250px;
            color: white;
            flex: 1 1 200px;
        }

        .feature-icon {
            width: 75px;
            height: 75px;
            background-color: #D9D9D9;
            border-radius: 50%;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .feature-content h4 {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .feature-content p {
            font-size: 14px;
            font-weight: 400;
            margin: 0;
        }

        /* About Section */
        .about-section {
            padding: 100px 20px;
            position: relative;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .about-content {
            flex: 1;
            position: relative;
        }

        .about-content h2 {
            font-size: 54px;
            color: #6C4F51;
        }

        .about-content h2 span:first-child {
            font-weight: 600;
        }

        .about-content h2 span:last-child {
            font-family: var(--brand-font);
            font-weight: 400;
        }

        .about-description {
            background-color: #8F7059;
            border-radius: 40px;
            padding: 40px;
            text-align: justify;
            border: 6px solid white;
            color: white;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.5;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        .question-mark {
            position: absolute;
            left: -80px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 128px;
            color: #4D403A;
            font-weight: 700;
        }

        .circle-wrapper {
            position: relative;
            z-index: 0;
        }

        .about-image {
            flex: 1;
        }

        .about-image img {
            width: 100%;
            max-width: 270px;
            height: auto;
            display: block;
            justify-content: flex-start;
        }

        /* Lingkaran kanan (dua warna) */
        .circle-wrapper {
            position: relative;
            z-index: 0;
        }

        .circle-wrapper::before {
            content: '';
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background-color: #E6DAD0;
            /* warna luar */
            z-index: -2;
            top: 50%;
            right: -290px;
            /* geser lebih keluar ke kanan */
            transform: translateY(-50%);
        }

        .circle-wrapper::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background-color: #DACFC5;
            /* warna dalam */
            z-index: -1;
            top: 50%;
            right: -270px;
            /* sejajar sama before */
            transform: translateY(-50%);
        }


        /* Lingkaran kiri (satu warna) */
        .circle-wrapper2 {
            position: relative;
            z-index: 0;
        }

        .circle-wrapper2::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 620px;
            border-radius: 50%;
            background-color: #DACFC5;
            z-index: -1;
            top: 50%;
            left: 0;
            transform: translate(-50%, -50%);
        }

        @media (max-width: 768px) {
            .circle-wrapper::before {
                width: 300px;
                height: 300px;
                right: -120px;
            }

            .circle-wrapper2::before {
                width: 300px;
                height: 300px;
                right: -120px;
            }

            .circle-wrapper::after {
                width: 260px;
                height: 260px;
                right: -100px;
            }

            .about-content h2 {
                font-size: 36px;
                text-align: center;
            }

            .about-description {
                font-size: 16px;
                padding: 30px;
                text-align: center;
            }

            .about-container {
                flex-direction: column;
                gap: 20px;
                align-items: center;
                text-align: center;
            }

            .about-image img {
                max-width: 200px;
            }
        }


        @media (max-width: 480px) {
            .logo h1 {
        font-size: 18px;
    }
            .circle-wrapper::before {
                width: 300px;
                height: 300px;
                right: -120px;
            }

            .circle-wrapper2::before {
                width: 400px;
                height: 400px;
            }

            .circle-wrapper::after {
                width: 260px;
                height: 260px;
                right: -100px;
            }

            .about-content h2 {
                font-size: 36px;
                text-align: center;
            }

            .about-description {
                font-size: 16px;
                padding: 30px;
                text-align: center;
            }

            .about-container {
                flex-direction: column;
                gap: 20px;
                align-items: center;
                text-align: center;
            }

            .about-image img {
                max-width: 200px;
            }
        }
        /* SDGs Section - Base Styles */
        .sdgs-section {
            padding: 80px 0;
            margin: 0;
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        .sdgs-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .sdgs-title {
            font-size: 2.5rem;
            color: #6B4145;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .sdgs-content-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center;
        }

        .sdgs-text-content {
            flex: 1;
        }

        .sdgs-content {
            font-size: 1.1rem;
            color: #6C4F51;
            font-weight: 600;
            line-height: 1.6;
            margin-bottom: 2.5rem;
            text-align: justify;
        }

        /* Image Container */
        .sdgs-image-container {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .sdgs-image-wrapper {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            justify-content: flex-end;
        }

        /* Circle Background */
        .circle-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 600px;
            width: 800px;
            background-color: #DACFC5;
            border-radius: 50%;
            transform: translate(-20%, -50%);
            z-index: 1;
            /* Di bawah gambar */
        }

        /* Image */
        .sdgs-image {
            position: relative;
            z-index: 2;
            /* Di atas lingkaran */
            width: 75%;
            max-width: 400px;
            height: auto;
            border-radius: 20px;
        }

        /* Cards Styles */
        .sdgs-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }

        .sdgs-card {
            width: 100%;
            max-width: 250px;
            margin: 0 auto;
        }

        .sdgs-card-header {
            background-color: #673E42;
            border-radius: 60px;
            padding: 5px;
            border: 6px solid white;
            position: relative;
            z-index: 2;
            margin-bottom: -30px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        }

        .sdgs-card-body {
            background-color: #8F7059;
            border-radius: 60px;
            padding: 40px 10px 10px;
            border: 6px solid white;
            min-height: 170px;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sdgs-card h3 {
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            text-align: center;
        }

        .sdgs-card p {
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            line-height: 1.3;
            margin: 0;
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .sdgs-title {
                font-size: 2.2rem;
            }

            .sdgs-content {
                font-size: 1rem;
            }

            .sdgs-card h3 {
                font-size: 1.5rem;
            }

            .sdgs-card p {
                font-size: 1.2rem;
            }

        }

        @media (max-width: 768px) {
            .sdgs-section {
                padding: 60px 15px;
            }

            .sdgs-content-wrapper {
                gap: 2rem;
            }

            .sdgs-title {
                font-size: 2rem;
                margin-bottom: 1.5rem;
            }

            .sdgs-content {
                font-size: 1rem;
                margin-bottom: 2rem;
                padding: 0;
            }

            .sdgs-image-wrapper {
                max-width: 400px;
            }

            .sdgs-image {
                width: 70%;
                max-width: 300px;
            }

            .circle-bg {
                max-width: 400px;
                z-index: 1;
                /* Pastikan tetap di bawah gambar */
            }
        }

        @media (max-width: 480px) {

            .sdgs-title {
                font-size: 1.8rem;
            }

            .sdgs-card {
                max-width: 100%;
            }

            .sdgs-card h3 {
                font-size: 0.5rem;
            }

            .sdgs-card p {
                font-size: 1.1rem;
            }

            .sdgs-card-body {
                min-height: 140px;
                padding-top: 35px;
            }

            .circle-bg {
                max-width: 500px;
                max-height: 400px;
            }

            .sdgs-image-wrapper {
                width: 60%;
            }

            .sdgs-card-header {
                background-color: #673E42;
                border-radius: 60px;
                padding: 5px;
                border: 6px solid white;
                position: relative;
                z-index: 2;
                margin-bottom: -30px;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            }

            .sdgs-card-body {
                background-color: #8F7059;
                border-radius: 60px;
                padding: 40px 10px 10px;
                border: 6px solid white;
                min-height: 170px;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sdgs-card h3 {
                color: white;
                font-size: 1rem;
                font-weight: 700;
                margin: 0;
                text-align: center;
            }

            .sdgs-card p {
                color: white;
                font-size: 1.5rem;
                font-weight: 700;
                text-align: center;
                line-height: 1.3;
                margin: 0;
            }
        }

        .features-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color: #493e39;
            padding: 40px;
            border-radius: 24px;
            gap: 32px;
            max-width: 1100px;
            width: 100%;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            color: white;
            width: calc(50% - 32px);
            max-width: 480px;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            background-color: #d9d9d9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-circle i {
            font-size: 20px;
            color: #493e39;
            transition: transform 0.5s ease;
        }

        .icon-circle:hover i {
            transform: rotate(360deg);
        }

        .feature-text h3 {
            font-size: 15px;
            font-weight: bold;
            margin: 0;
            line-height: 1.3;
        }

        .feature-text p {
            font-size: 13px;
            margin: 4px 0 0 0;
            color: #e5e5e5;
            line-height: 1.5;
        }

        /* RESPONSIVE - untuk ukuran mobile */
        @media (max-width: 768px) {
            .feature-item {
                width: 100%;
            }

            .features-container {
                padding: 24px;
                gap: 24px;
            }

            .icon-circle {
                width: 40px;
                height: 40px;
            }

            .icon-circle i {
                font-size: 16px;
            }

            .feature-text h3 {
                font-size: 14px;
            }

            .feature-text p {
                font-size: 12px;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 1024px) {
            .sdgs-title {
                font-size: 2.2rem;
            }

            .sdgs-content {
                font-size: 1rem;
            }

            .sdgs-card h3 {
                font-size: 1.5rem;
            }

            .sdgs-card p {
                font-size: 1.2rem;
            }

        }

        @media (max-width: 768px) {
            .sdgs-section {
                padding: 60px 15px;
            }

            .sdgs-content-wrapper {
                gap: 2rem;
            }

            .sdgs-title {
                font-size: 2rem;
                margin-bottom: 1.5rem;
            }

            .sdgs-content {
                font-size: 1rem;
                margin-bottom: 2rem;
                padding: 0;
            }

            .sdgs-image-wrapper {
                max-width: 400px;
            }

            .sdgs-image {
                width: 70%;
                max-width: 300px;
            }

            .circle-bg {
                max-width: 400px;
                z-index: 1;
                /* Pastikan tetap di bawah gambar */
            }
        }

        @media (max-width: 480px) {

            .sdgs-title {
                font-size: 1.8rem;
            }

            .sdgs-card {
                max-width: 100%;
            }

            .sdgs-card h3 {
                font-size: 0.5rem;
            }

            .sdgs-card p {
                font-size: 1.1rem;
            }

            .sdgs-card-body {
                min-height: 140px;
                padding-top: 35px;
            }

            .circle-bg {
                max-width: 500px;
                max-height: 400px;
            }

            .sdgs-image-wrapper {
                width: 60%;
            }

            .sdgs-card-header {
                background-color: #673E42;
                border-radius: 60px;
                padding: 5px;
                border: 6px solid white;
                position: relative;
                z-index: 2;
                margin-bottom: -30px;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            }

            .sdgs-card-body {
                background-color: #8F7059;
                border-radius: 60px;
                padding: 40px 10px 10px;
                border: 6px solid white;
                min-height: 170px;
                box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sdgs-card h3 {
                color: white;
                font-size: 1rem;
                font-weight: 700;
                margin: 0;
                text-align: center;
            }

            .sdgs-card p {
                color: white;
                font-size: 1.5rem;
                font-weight: 700;
                text-align: center;
                line-height: 1.3;
                margin: 0;
            }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .sdgs-text-content {
                margin-left: 30px;
                margin-right: 25px;
            }
            .hero-content h1 {
                font-size: 60px;
            }

            .hero-content h2 {
                font-size: 28px;
            }

            .about-content h2 {
                font-size: 48px;
            }

            .about-description {
                font-size: 20px;
            }

            .sdgs-image {
                width: 350px;
            }
        }

        @media (max-width: 992px) {
            .sdgs-text-content {
                margin-left: 20px;
            }
            .header-container {
                justify-content: flex-end;
            }

            .logo {
                position: static;
                transform: none;
                margin-right: auto;
            }

            .navmenu {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
            }

            .hero .container,
            .about-container {
                flex-direction: column;
            }

            .hero-content,
            .about-content {
                max-width: 100%;
                margin-bottom: 40px;
                text-align: center;
            }

            .hero-buttons {
                display: flex;
                justify-content: center;
            }

            .question-mark {
                position: static;
                transform: none;
                text-align: center;
                margin: 20px 0;
            }

            .features-container {
                flex-wrap: wrap;
                gap: 30px;
            }

            .sdgs-cards {
                flex-direction: column;
                align-items: center;
            }

            .sdgs-image {
                position: static;
                transform: none;
                margin: 40px auto;
                width: 100%;
                max-width: 400px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 100px 0 60px;
            }

            .hero-content h1 {
                font-size: 48px;
            }

            .about-content h2 {
                font-size: 36px;
            }

            .sdgs-title {
                font-size: 36px;
            }

            .sdgs-content {
                font-size: 20px;
            }

            .about-description {
                padding: 30px;
            }

            .sdgs-card {
                width: 100%;
                max-width: 378px;
            }

            .sdgs-card-body {
                height: auto;
                padding: 40px 20px 20px;
            }

            .sdgs-card p {
                font-size: 28px;
            }
        }

        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 36px;
            }

            .hero-content h2 {
                font-size: 24px;
            }

            .hero-buttons .btn-primary {
                padding: 10px 20px;
                font-size: 18px;
            }

            .about-content h2 {
                font-size: 28px;
            }

            .question-mark {
                font-size: 80px;
            }

            .about-description {
                padding: 20px;
                font-size: 18px;
            }

            .sdgs-title {
                font-size: 28px;
            }

            .sdgs-content {
                font-size: 18px;
            }

            .sdgs-card h3 {
                font-size: 28px;
            }

            .sdgs-card p {
                font-size: 24px;
            }
        }
        @media (max-width: 380px) {
            .sdgs-text-content {
                margin: 25px;
            }
            .hero-content h1 {
                font-size: 36px;
            }

            .hero-content h2 {
                font-size: 24px;
            }

            .hero-buttons .btn-primary {
                padding: 10px 20px;
                font-size: 18px;
            }

            .about-content h2 {
                font-size: 28px;
            }

            .question-mark {
                font-size: 80px;
            }

            .about-description {
                padding: 20px;
                font-size: 18px;
            }

            .sdgs-title {
                font-size: 28px;
            }

            .sdgs-content {
                font-size: 14px;
            }

            .sdgs-card h3 {
                font-size: 18px;
            }

            .sdgs-card p {
                font-size: 18px;
            }
        }

        /* Animasi Fade In */
        .fade-in {
            animation: fadeIn 1s ease-in-out;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Animasi Fade Out */
        .fade-out {
            animation: fadeOut 1s ease-in-out;
            opacity: 1;
            animation-fill-mode: forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        /* Animasi Slide Up */
        .slide-up {
            animation: slideUp 1s ease-out;
            transform: translateY(50px);
            opacity: 0;
            animation-fill-mode: forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Animasi Slide Down */
        .slide-down {
            animation: slideDown 1s ease-out;
            transform: translateY(-50px);
            opacity: 0;
            animation-fill-mode: forwards;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Animasi Zoom In */
        .zoom-in {
            animation: zoomIn 1s ease-out;
            transform: scale(0.9);
            opacity: 0;
            animation-fill-mode: forwards;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Animasi Rotate */
        .rotate {
            animation: rotate 1s ease-out;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Animasi Pulse */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Animasi Bounce */
        .bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-20px);
            }

            60% {
                transform: translateY(-10px);
            }
        }

        /* Animasi Floating */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Animasi untuk Hero Section */
        .hero h1 {
            animation: fadeIn 1s ease-out 0.2s forwards, slideDown 1s ease-out 0.2s forwards;
            opacity: 0;
        }

        .hero h2 {
            animation: fadeIn 1s ease-out 0.5s forwards, slideUp 1s ease-out 0.5s forwards;
            opacity: 0;
        }

        .hero-buttons {
            animation: fadeIn 1s ease-out 0.8s forwards, zoomIn 1s ease-out 0.8s forwards;
            opacity: 0;
        }

        .hero-image img {
            animation: fadeIn 1s ease-out 0.5s forwards, floating 3s ease-in-out infinite 1s;
            opacity: 0;
        }

        /* Animasi untuk Fitur */
        .feature-item:nth-child(1) {
            animation: fadeIn 1s ease-out 0.5s forwards, slideUp 1s ease-out 0.5s forwards;
            opacity: 0;
        }

        .feature-item:nth-child(2) {
            animation: fadeIn 1s ease-out 0.7s forwards, slideUp 1s ease-out 0.7s forwards;
            opacity: 0;
        }

        .feature-item:nth-child(3) {
            animation: fadeIn 1s ease-out 0.9s forwards, slideUp 1s ease-out 0.9s forwards;
            opacity: 0;
        }

        .feature-item:nth-child(4) {
            animation: fadeIn 1s ease-out 1.1s forwards, slideUp 1s ease-out 1.1s forwards;
            opacity: 0;
        }

        /* Animasi untuk About Section */
        .about-image img {
            animation: fadeIn 1s ease-out 0.5s forwards, zoomIn 1s ease-out 0.5s forwards;
            opacity: 0;
        }

        .about-content h2 {
            animation: fadeIn 1s ease-out 0.3s forwards, slideDown 1s ease-out 0.3s forwards;
            opacity: 0;
        }

        .about-description {
            animation: fadeIn 1s ease-out 0.6s forwards, slideUp 1s ease-out 0.6s forwards;
            opacity: 0;
        }

        /* Animasi untuk SDGS Section */
        .sdgs-title {
            animation: fadeIn 1.5s ease-out 0.5s forwards, slideDown 1.5s ease-out 0.5s forwards;
            opacity: 0;
        }

        .sdgs-content {
            animation: fadeIn 1.5s ease-out 0.9s forwards, slideUp 1.5s ease-out 0.9s forwards;
            opacity: 0;
        }

        .sdgs-card:nth-child(1) {
            animation: fadeIn 1.5s ease-out 1.2s forwards, slideUp 1.5s ease-out 1.2s forwards;
            opacity: 0;
        }

        .sdgs-card:nth-child(2) {
            animation: fadeIn 1.5s ease-out 1.5s forwards, slideUp 1.5s ease-out 1.5s forwards;
            opacity: 0;
        }

        .sdgs-image {
            animation: fadeIn 1.5s ease-out 1s forwards, zoomIn 1.5s ease-out 1s forwards;
            opacity: 0;
        }

        /* Efek hover untuk card fitur */
        .feature-item {
            transition: all 1s ease;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Efek hover untuk SDGS card */
        .sdgs-card {
            transition: all 1s ease;
        }

        .sdgs-card:hover {
            transform: scale(1.05);
        }

        /* Animasi untuk header saat scroll */
        .header.scrolled {
            animation: fadeInDown 0.5s ease-out;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>KostFinder</h1>
                    <h2>Dekat Kampus, Dekat Impian<br>Temukan Kos Idealmu!</h2>
                    <div class="hero-buttons">
                        <a href="{{ route('map') }}" class="btn btn-primary">Cari kos</a>
                        @if (Auth::check())
                            <a href="{{ route('addMap') }}" class="btn btn-primary">Tambahkan Kos</a>
                        @endif
                    </div>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('asset/img/hero.png') }}" alt="Hero Image">
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="box4" class="box4">
            <div class="features-container">
                <div class="feature-item">
                    <div class="icon-circle">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Pemetaan Interaktif</h3>
                        <p>Temukan kos terbaik melalui fitur pada peta interaktif.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="icon-circle">
                        <i class="fas fa-filter"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Filter Sesuai Kebutuhan</h3>
                        <p>Cari kos berdasarkan harga dan fasilitas.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="icon-circle">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Informasi Lengkap</h3>
                        <p>Lihat harga, fasilitas, foto, kontak pemilik, dan alamat lengkap kos.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="icon-circle">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="feature-text">
                        <h3>Chat dengan Pemilik</h3>
                        <p>Hubungi pemilik kos untuk tanya atau reservasi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <div class="about-container">
                <div class="circle-wrapper2">
                    <div class="about-image">
                        <img src="{{ asset('asset/img/about.png') }}" alt="About Image">
                    </div>
                </div>
                <div class="about-content">
                    <div class="circle-wrapper">
                        <h2><span>Apa itu</span> <span>KostFinder</span><span>?</span></h2>
                        <div class="about-description">
                            KostFinder adalah solusi pintar untuk menemukan kos impian bagi Anda yang berkuliah di kampus wilayah Kabupaten
                            Sleman seperti UGM atau UNY. Dilengkapi dengan pemetaan interaktif, filter pencarian, dan informasi lengkap,
                            mencari tempat tinggal yang nyaman kini menjadi lebih cepat dan praktis!
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="sdgs-section">
            <div class="sdgs-container">
                <h2 class="sdgs-title">Mendukung SDGS 4 dan 11</h2>
                <div class="sdgs-content-wrapper">
                    <!-- Konten Teks dan Kartu -->
                    <div class="sdgs-text-content">
                        <p class="sdgs-content">
                            Solusi ini tidak hanya memudahkan pencarian kos, tetapi juga mendukung Tujuan Pembangunan
                            Berkelanjutan (SDGs) poin 4 (Pendidikan Berkualitas) dan poin 11 (Kota dan Komunitas Berkelanjutan).
                            Dengan meningkatkan akses informasi bagi mahasiswa serta memperluas visibilitas bagi pemilik kos,
                            aplikasi ini turut berkontribusi dalam mewujudkan pembangunan berkelanjutan di kawasan pendidikan.
                        </p>

                        <div class="sdgs-cards">
                            <div class="sdgs-card">
                                <div class="sdgs-card-header">
                                    <h3>SDGs 4</h3>
                                </div>
                                <div class="sdgs-card-body">
                                    <p>Pendidikan<br>Berkualitas</p>
                                </div>
                            </div>

                            <div class="sdgs-card">
                                <div class="sdgs-card-header">
                                    <h3>SDGs 11</h3>
                                </div>
                                <div class="sdgs-card-body">
                                    <p>Kota dan<br>Komunitas<br>Berkelanjutan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gambar dengan Lingkaran -->
                    <div class="sdgs-image-container">
                        <div class="sdgs-image-wrapper">
                            <img src="{{ asset('asset/img/sdgs.png') }}" alt="SDGs Image" class="sdgs-image">
                            <div class="circle-bg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
