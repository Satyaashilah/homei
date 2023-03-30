<template>
    <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
                                <div class="card-body p-4">

                                    <div class="row">
                                        <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                                            <form>
                                                <div class="d-flex flex-row pb-3">
                                                    <div class="d-flex align-items-center pe-2">
                                                        <input class="form-check-input" type="radio" name="radioNoLabel"
                                                            id="radioNoLabel1v" value="" aria-label="..." checked />
                                                    </div>
                                                    <div class="rounded border w-100 p-3">
                                                        <p class="d-flex align-items-center mb-0">
                                                            <i class="fab fa-cc-mastercard fa-2x text-dark pe-2"></i>Credit
                                                            Card
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row pb-3">
                                                    <div class="d-flex align-items-center pe-2">
                                                        <input class="form-check-input" type="radio" name="radioNoLabel"
                                                            id="radioNoLabel2v" value="" aria-label="..." />
                                                    </div>
                                                    <div class="rounded border w-100 p-3">
                                                        <p class="d-flex align-items-center mb-0">
                                                            <i class="fab fa-cc-visa fa-2x fa-lg text-dark pe-2"></i>Debit
                                                            Card
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row">
                                                    <div class="d-flex align-items-center pe-2">
                                                        <input class="form-check-input" type="radio" name="radioNoLabel"
                                                            id="radioNoLabel3v" value="" aria-label="..." />
                                                    </div>
                                                    <div class="rounded border w-100 p-3">
                                                        <p class="d-flex align-items-center mb-0">
                                                            <i
                                                                class="fab fa-cc-paypal fa-2x fa-lg text-dark pe-2"></i>PayPal
                                                        </p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-6">
                                            <div class="row">
                                                <div class="col-12 col-xl-6">
                                                    <div class="form-outline mb-4 mb-xl-5">
                                                        <input type="text" id="typeName"
                                                            class="form-control form-control-lg" siez="17"
                                                            placeholder="John Smith" />
                                                        <label class="form-label" for="typeName">Name on card</label>
                                                    </div>


                                                </div>
                                                <div class="col-12 col-xl-6">
                                                    <div class="form-outline mb-4 mb-xl-5">
                                                        <input type="text" id="typeText"
                                                            class="form-control form-control-lg" siez="17"
                                                            placeholder="1111 2222 3333 4444" minlength="19"
                                                            maxlength="19" />
                                                        <label class="form-label" for="typeText">Card Number</label>
                                                    </div>

                                                    <div class="form-outline mb-4 mb-xl-5">
                                                        <input type="password" id="typeText"
                                                            class="form-control form-control-lg"
                                                            placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3"
                                                            maxlength="3" />
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

                                        </div>
                                    </div>

                                </div>
                            </div>
</template>

<script setup>
import { RouterView, RouterLink } from 'vue-router'

  const navigation = [
    // { name: 'Home', href: '/' },
    // { name: 'Cart', href: '/Cart' },
    // { name: 'Catalogue', href: '/Catalogue' },
    { name: 'ProductDetail', href: '/ProductDetail' },
  ]
</script>