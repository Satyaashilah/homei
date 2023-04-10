<template>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

    <div class="w-screen">
        <div class="mx-16">
            <div class="row mt-28">
                <div class="profile-nav col-md-3">
                    <div class="panel-auto">
                        <div class="user-heading round">
                            <a href="#">
                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                            </a>
                            <h1>Camila Smith</h1>
                            <p>deydey@theEmail.com</p>
                        </div>

                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"> <i class="fa fa-user"></i> Profil</a></li>
                            <li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
                            <li><a href="#"> <i class="fa fa-calendar"></i> Keranjang <span
                                        class="label label-warning pull-right r-activity">9</span></a></li>
                            <li><a href="#"> <i class="fa fa-edit"></i> Riwayat Transaksi</a></li>
                            <li><a href="#"> <i class="fa fa-edit"></i> Pengiriman</a></li>
                        </ul>
                    </div>
                </div>
                <div class="profile-info col-md-9">
                    <div class="panel ">
                        <div class="panel-body bio-graph-info">
                            <div class="grid grid-cols-2 gap-8">
                                <h4 class="mb-4 mt-0">Profil Saya</h4>
                                <h4 class="mb-4 mt-0 ml-20">Upload your profile photo</h4>
                            </div>
                            <div class="grid grid-cols-2 gap-8 place-content-center">
                                <div>
                                    <div class="col mt-2">
                                        <!-- First Name -->
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="First name"
                                            value="Scaralet">
                                    </div>
                                    <!-- Last name -->
                                    <div class="col mt-2">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Last name"
                                            value="Doe">
                                    </div>
                                    <!-- Phone number -->
                                    <div class="col mt-2">
                                        <label class="form-label">Phone number *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Phone number"
                                            value="(333) 000 555">
                                    </div>
                                    <!-- Mobile number -->
                                    <div class="col mt-2">
                                        <label class="form-label">Mobile number *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Phone number"
                                            value="+91 9852 8855 252">
                                    </div>
                                    <!-- Email -->
                                    <div class="col mt-2">
                                        <label for="inputEmail4" class="form-label">Email *</label>
                                        <input type="email" class="form-control" id="inputEmail4"
                                            value="example@homerealty.com">
                                    </div>
                                    <!-- Skype -->
                                    <div class="col mt-2">
                                        <label class="form-label">Skype *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="Phone number"
                                            value="Scaralet D">
                                    </div>
                                </div>
                                <div class="col-xxl-4 ml-20">
                                    <div
                                        class="text-center bg-secondary-soft py-3/6 w-5/6 h-2/3 flex justify-center items-center px-auto rounded">
                                        <div class="bg-white h-3/5 w-3/5 flex justify-center items-center">
                                            <i
                                                class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
                                        </div>

                                    </div>
                                    <div class="grid grid-cols-2 flex justify-between">
                                        <div>
                                            <input type="file" @change="onFileSelected">
                                        </div>
                                        <div class="ml-16 pl-2">
                                            <button
                                                class=" :outline-none text-white bg-yellow-300 hover:bg-yellow-400 focus:ring-1 focus:ring-yellow-200 font-medium rounded-sm text-sm w-28 py-2 dark:bg-yellow-300 dark:hover:bg-yellow-400 dark:focus:ring-yellow-300"
                                                @click="onUpload">Upload</button>
                                        </div>
                                        <!-- <div>
                                        <button class=" :outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-1 focus:ring-red-300 font-medium rounded-sm text-sm w-28 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" @click="onUpload">Remove</button>
                                    </div> -->
                                    </div>
                                    <div class="mb-0 mt-24 pt-4 ml-64 pl-16">
                                        <button class="w-auto h-auto px-5 py-3 text-white bg-yellow-300">Simpan
                                            Perubahan</button>
                                    </div>
                                </div>
                            </div> <!-- Row END -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
      
<script>
import { ref, onMounted } from 'vue'
export default {
}
</script>
      
<style scoped>
body {
    color: #797979;
    background: #f1f2f7;
    font-family: 'Open Sans', sans-serif;
    padding: 0px !important;
    margin: 0px !important;
    font-size: 13px;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-font-smoothing: antialiased;
}

.profile-nav,
.profile-info {
    margin-top: 30px;
}

.profile-nav .user-heading {
    background: #fbc02d;
    color: #fff;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    padding: 30px;
    text-align: center;
}

.profile-nav .user-heading.round a {
    border-radius: 50%;
    -webkit-border-radius: 50%;
    border: 10px solid rgba(255, 255, 255, 0.3);
    display: inline-block;
}

.profile-nav .user-heading a img {
    width: 112px;
    height: 112px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
}

.profile-nav .user-heading h1 {
    font-size: 22px;
    font-weight: 300;
    margin-bottom: 5px;
}

.profile-nav .user-heading p {
    font-size: 12px;
}

.profile-nav ul {
    margin-top: 1px;
}

.profile-nav ul>li {
    border-bottom: 1px solid #ebeae6;
    margin-top: 0;
    line-height: 30px;
}

.profile-nav ul>li:last-child {
    border-bottom: none;
}

.profile-nav ul>li>a {
    border-radius: 0;
    -webkit-border-radius: 0;
    color: #89817f;
    border-left: 5px solid #fff;
}

.profile-nav ul>li>a:hover,
.profile-nav ul>li>a:focus,
.profile-nav ul li.active a {
    background: #f8f7f5 !important;
    border-left: 5px solid #fbc02d;
    color: #89817f !important;
}

.profile-nav ul>li:last-child>a:last-child {
    border-radius: 0 0 4px 4px;
    -webkit-border-radius: 0 0 4px 4px;
}

.profile-nav ul>li>a>i {
    font-size: 16px;
    padding-right: 10px;
    color: #bcb3aa;
}

.r-activity {
    margin: 6px 0 0;
    font-size: 12px;
}


.p-text-area,
.p-text-area:focus {
    border: none;
    font-weight: 300;
    box-shadow: none;
    color: #c3c3c3;
    font-size: 16px;
}

.profile-info .panel-footer {
    background-color: #f8f7f5;
    border-top: 1px solid #e7ebee;
}

.profile-info .panel-footer ul li a {
    color: #7a7a7a;
}

.bio-graph-heading {
    background: #fbc02d;
    color: #fff;
    text-align: center;
    font-style: italic;
    padding: 40px 110px;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
    font-size: 16px;
    font-weight: 300;
}

.bio-graph-info {
    color: #89817e;
}

.bio-graph-info h1 {
    font-size: 22px;
    font-weight: 300;
    margin: 0 0 20px;
}

.bio-row {
    width: 50%;
    float: left;
    margin-bottom: 10px;
    padding: 0 15px;
}

.bio-row p span {
    width: 100px;
    display: inline-block;
}

.bio-chart,
.bio-desk {
    float: left;
}

.bio-chart {
    width: 40%;
}

.bio-desk {
    width: 60%;
}

.bio-desk h4 {
    font-size: 15px;
    font-weight: 400;
}

.bio-desk h4.terques {
    color: #4CC5CD;
}

.bio-desk h4.red {
    color: #e26b7f;
}

.bio-desk h4.green {
    color: #97be4b;
}

.bio-desk h4.purple {
    color: #caa3da;
}

.file-pos {
    margin: 6px 0 10px 0;
}

.profile-activity h5 {
    font-weight: 300;
    margin-top: 0;
    color: #c3c3c3;
}

.summary-head {
    background: #ee7272;
    color: #fff;
    text-align: center;
    border-bottom: 1px solid #ee7272;
}

.summary-head h4 {
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.summary-head p {
    color: rgba(255, 255, 255, 0.6);
}

ul.summary-list {
    display: inline-block;
    padding-left: 0;
    width: 100%;
    margin-bottom: 0;
}

ul.summary-list>li {
    display: inline-block;
    width: 19.5%;
    text-align: center;
}

ul.summary-list>li>a>i {
    display: block;
    font-size: 18px;
    padding-bottom: 5px;
}

ul.summary-list>li>a {
    padding: 10px 0;
    display: inline-block;
    color: #818181;
}

ul.summary-list>li {
    border-right: 1px solid #eaeaea;
}

ul.summary-list>li:last-child {
    border-right: none;
}

.bg-secondary-soft {
    background-color: rgba(208, 212, 217, 0.1) !important;
}

.rounded {
    border-radius: 5px !important;
}

.py-5 {
    padding-top: 3rem !important;
    padding-bottom: 3rem !important;
}

.px-4 {
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important;
}

.file-upload .square {
    height: 250px;
    width: 250px;
    margin: auto;
    vertical-align: middle;
    border: 1px solid #e5dfe4;
    background-color: #fff;
    border-radius: 5px;
}

.text-secondary {
    --bs-text-opacity: 1;
    color: rgba(208, 212, 217, 0.5) !important;
}

.btn-success-soft {
    color: #28a745;
    background-color: rgba(40, 167, 69, 0.1);
}

.btn-danger-soft {
    color: #dc3545;
    background-color: rgba(220, 53, 69, 0.1);
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.5rem 1rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.6;
    color: #29292e;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #e5dfe4;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 5px;
    -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
}
</style>
      