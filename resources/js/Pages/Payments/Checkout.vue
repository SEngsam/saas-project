<template>
  <div class="container mt-5">
    <h2 class="mb-4">Pay with PayPal</h2>
    <div id="paypal-button-container"></div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'

// ستتغير هذه في الإنتاج (نستخدم ساندبوكس الآن)
const paypalClientId = 'YOUR_PAYPAL_SANDBOX_CLIENT_ID'

onMounted(() => {
  const script = document.createElement('script')
  script.src = `https://www.paypal.com/sdk/js?client-id=${paypalClientId}&currency=USD`
  script.onload = () => {
    window.paypal.Buttons({
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '10.00' // السعر بالدولار
            }
          }]
        })
      },
      onApprove: (data, actions) => {
        return actions.order.capture().then((details) => {
          alert('Payment successful by ' + details.payer.name.given_name)

          // إرسال التفاصيل إلى Laravel
          fetch('/paypal/complete-payment', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
              orderId: data.orderID,
              payer: details.payer,
              purchase_units: details.purchase_units,
            })
          })
        })
      }
    }).render('#paypal-button-container')
  }
  document.body.appendChild(script)
})
</script>
