<x-dashlayout>
    @auth
    <div class="card">
        <div class="card-body">
            <form action="/dashboard/pay" method="post">
                @csrf
                <div class="form-group">
                    <label for="amount">Amount:</label>
                    <input type="text" name="amount" id="amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method:</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="stripe">Stripe</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="stripeToken">Stripe Token:</label>
                    <input type="text" name="stripeToken" id="stripeToken" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Pay</button>
            </form>
        </div>
    </div>
    @else
    <script>window.location = "/login";</script>
    @endauth
</x-dashlayout>