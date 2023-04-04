<template>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="bg-gray-50 pt-20 mt-20 mb-20 mx-auto px-8 ">
        <div class="grid grid-cols-2 gap-7">
            <h4> Informasi Pengiriman</h4>
            <h4> Pesanan</h4>
            <div class="grid grid-rows-6">
                <div class="grid grid-cols-2 gap-4 pt-3">
                    <div class="col-span-2">Nama Penerima
                        <div class="pt-1 shadow-sm">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-3">
                    <div class="col-span-2">Nomor Telepon
                        <div class="pt-1 shadow-sm">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-3">
                    <div>Provinsi
                        <div class="pt-1 shadow-sm">
                            <select class="form-select">
                                <option selected disabled value="">Provinsi...</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div>Kota
                        <div class="pt-1 shadow-sm">
                            <select class="form-select">
                                <option selected disabled value="">Kota...</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-3">
                    <div>Kecamatan
                        <div class="pt-1 shadow-sm">
                            <select class="form-select">
                                <option selected disabled value="">Kecamatan...</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>
                    <div>Desa
                        <div class="pt-1 shadow-sm">
                            <select class="form-select">
                                <option selected disabled value="">Desa...</option>
                                <option>{{ desa.nama }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">Alamat
                        <div class="pt-1 shadow-sm">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-3">
                    <div>Kode Pos
                        <div class="pt-1 shadow-sm">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-white w-full h-full rounded border border-neutral shadow-md ">
                <div class="grid grid-cols-3 pt-3">
                    <div>
                        <div class="box-border h-32 w-32 p-4 border-1 rounded mt-10 ml-10">
                            <img src="./../assets/homei.png" alt="Avatar Tailwind CSS Component" />
                        </div>
                    </div>
                    <div class="grid grid-rows-2">
                        <div class="mt-10 ">Nama Produk
                            {{ '' }}
                        </div>
                        <div class="mt-6">Harga
                            {{ '' }}
                        </div>
                    </div>
                    <div class="grid grid-rows-2">
                        <div class="mt-10 ml-28">
                            
                        </div>
                        <div class="mt-6 ml-28">
                            <input id="form1" min="0" name="quantity" value="1" type="number"
                                class="form-control form-control-sm" style="width: 50px;" />

                            <button class="btn btn-link px-2"
                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="border border-b border-grey-50 w-full mt-4"></div>
            </div>
        </div>
    </div>
    <!-- <div class="card shadow-2-strong mb-5 mb-lg-0 pt-20 mt-20" style="border-radius: 16px;">
        <div class="card-body p-4">

            <div class="row">
                <form>
                    <input class="form-check-input mr-5" type="radio" name="radioNoLabel" id="radioNoLabel1v" value=""
                        aria-label="..." checked />
                    <i class="rounded border w-2/5 p-3 fa-cc-mastercard fa-2x text-dark pe-2">Credit Card</i>
                    <input class="form-check-input ml-16 mr-5" type="radio" name="radioNoLabel" id="radioNoLabel1v" value=""
                        aria-label="..." checked />
                    <i class="rounded border w-2/5 p-3 fab fa-cc-visa fa-2x fa-lg text-dark pe-2">Debit Card</i>
                    


                </form> -->
    <!-- <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                    <form>
                        <div class="d-flex flex-row pb-3">
                            <div class="d-flex align-items-center pe-2">
                                <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1v"
                                    value="" aria-label="..." checked />
                                    <div class="rounded border w-1/5 p-3">
                                        <p class="d-flex align-items-center mb-0">
                                            <i class="fab fa-cc-mastercard fa-2x text-dark pe-2"></i>Credit
                                            Card
                                        </p>
                                    </div>
                            </div>
                        </div>
                        <div class="d-flex flex-row pb-3">
                            <div class="d-flex align-items-center pe-2">
                                <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2v"
                                    value="" aria-label="..." />
                            </div>
                            <div class="rounded border w-1/5 p-3">
                                <p class="d-flex align-items-center mb-0">
                                    <i class="fab fa-cc-visa fa-2x fa-lg text-dark pe-2"></i>Debit
                                    Card
                                </p>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="d-flex align-items-center pe-2">
                                <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel3v"
                                    value="" aria-label="..." />
                            </div>
                            <div class="rounded border w-1/5 p-3">
                                <p class="d-flex align-items-center mb-0">
                                    <i class="fab fa-cc-paypal fa-2x fa-lg text-dark pe-2"></i>PayPal
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-6">
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="form-outline mb-4 mb-xl-5">
                                <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                                    placeholder="John Smith" />
                                <label class="form-label" for="typeName">Name on card</label>
                            </div>


                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-outline mb-4 mb-xl-5">
                                <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                                    placeholder="1111 2222 3333 4444" minlength="19" maxlength="19" />
                                <label class="form-label" for="typeText">Card Number</label>
                            </div>

                            <div class="form-outline mb-4 mb-xl-5">
                                <input type="password" id="typeText" class="form-control form-control-lg"
                                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                <label class="form-label" for="typeText">Cvv</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-2">Subtotal</p>
                        <p class="mb-2">$23.49</p>
                    </div>

                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                        <p class="mb-0">Shipping</p>
                        <p class="mb-0">$2.99</p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                        <p class="mb-2">Total (tax included)</p>
                        <p class="mb-2">$26.48</p>
                    </div>

                    <button type="button" class="btn btn-primary btn-block btn-lg">
                        <div class="d-flex justify-content-between">
                            <span>Checkout</span>
                            <span>$26.48</span>
                        </div>
                    </button>

                </div> -->
    <!-- </div>

        </div>
    </div> -->
</template>

<script setup>
import { RouterView, RouterLink } from 'vue-router'

// defineProps({
//   desa: Array,
// })
const navigation = [
    // { name: 'Home', href: '/' },
    // { name: 'Cart', href: '/Cart' },
    // { name: 'Catalogue', href: '/Catalogue' },
    { name: 'ProductDetail', href: '/ProductDetail' },
]
</script>