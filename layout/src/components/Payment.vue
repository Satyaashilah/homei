<template>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <div class="bg-gray-50 pt-20 mt-20 mb-auto mx-auto px-8 ">
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
                                <option>..</option>
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
                <div class="grid grid-cols-2 gap-4 pt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                        <label class="form-check-label" for="flexCheckDefault">Shipping address is the same as my billing
                            address</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                        <label class="form-check-label" for="flexCheckDefault">Save this information for next time</label>
                    </div>
                </div>

            </div>

            <!-- Order Summary -->
            <div class="bg-white w-full h-fit rounded border border-neutral shadow-md ">
                <div class="relative overflow-x-auto shadow-sm ">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Produk
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kuantitas
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Harga
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-32 p-4">
                                    <img src="/docs/images/products/apple-watch.png" alt="Apple Watch">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    Apple Watch
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <input type="number" id="first_product"
                                                class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="1" required>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    $599
                                </td>
                                <td class="px-6 py-4">
                                    <button
                                        class=" :outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm w-16 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Hapus</button>
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-32 p-4">
                                    <img src="/docs/images/products/imac.png" alt="Apple Imac">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    Imac 27"
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <input type="number" id="second_product"
                                                class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="1" required>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    $2499
                                </td>
                                <td class="px-6 py-4">
                                    <button
                                        class=" :outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm w-16 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Hapus</button>
                                </td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-32 p-4">
                                    <img src="/docs/images/products/iphone-12.png" alt="Iphone 12">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    Iphone 12
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div>
                                            <input type="number" id="third_product"
                                                class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="1" required>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    $999
                                </td>
                                <td class="px-6 py-4">
                                    <button
                                        class=" :outline-none text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-sm text-sm w-16 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white h-20 inset-x-0 bottom-0">
                        <table class="table-auto w-full justify-center ">
                            <thead class="h-20 justify-center bg-white">
                                <tr>
                                <th class="text-right font-medium text-sm text-gray-600">Total Harga :</th>
                                    <th>
                                        Rp
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
        <button
            class=":outline-none mt-5 mb-10 mr-11 text-white bg-yellow-300 hover:bg-yellow-200 focus:ring-4 focus:ring-yellow-200 font-medium rounded-sm text-sm w-full py-2 bg-yellow-300 :hover:bg-yellow-200 focus:ring-yellow-200">
            Simpan</button>
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
    </div> --></template>

<script setup>
// const desa = ref([]);
</script>