@extends('base.pageBody')

@section('body')
    <div class="container mt-5" id="app">
        <h2>New ☕ Sales</h2>
        <div class="row">
            <div class="col-12 my-5 text-end">
                <a href="{{route('all-sales')}}">Switch To All Products</a>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label>Quantity:</label>
                    <input type="number" class="form-control" v-model.number="quantity" placeholder="quantity">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label>Unit Cost (£):</label>
                    <input type="number" class="form-control" v-model.number="unitCost" placeholder="Unit cost">
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <div><strong>Selling Price</strong></div>
                    <div><strong>£[[ sellingPrice.toFixed(2) ]]</strong></div>
                </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" @click="recordSale">Record Sale</button>

            </div>
        </div>

        <h3 class="mt-5">Previous Sales</h3>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>Quantity</th>
                <th>Unit Cost</th>
                <th>Selling Price</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(sale,i) in sales" :key="i">
                <td>[[ sale.quantity ]]</td>
                <td>£[[ sale.unit_cost.toFixed(2) ]]</td>
                <td>£[[ sale.selling_price.toFixed(2) ]]</td>
            </tr>
            </tbody>
        </table>
    </div>

    <script>
        new Vue({
            el: "#app",
            delimiters: ['[[', ']]'],
            data: {
                quantity: 1,
                unitCost: 10,
                profitMargin: 0.25, //default for primary product
                shippingCost: 10.00,
                sales: [],
                product: @json($product ?? [])
            },
            computed: {
                sellingPrice() {
                    let cost = this.quantity * this.unitCost;
                    return (cost / (1 - this.profitMargin)) + this.shippingCost;
                }
            },
            methods: {
                recordSale() {
                    if (this.quantity > 0 && this.unitCost > 0) {
                        const saleData = {
                            quantity: this.quantity,
                            unit_cost: this.unitCost,
                            // selling_price: this.sellingPrice
                        };

                        // Send POST request to backend
                        axios.post('/sales/store', saleData)
                            .then(response => {
                                const {quantity, unit_cost, selling_price} = response.data['data']
                                this.sales.unshift({quantity, unit_cost, selling_price});

                                // Reset input fields
                                this.quantity = 1;
                                this.unitCost = 10;
                            })
                            .catch(error => {
                                const err = error.response ? error.response.data : error
                                console.error('Error recording sale:', error.response ? error.response.data : error);
                                alert(err.message);

                            });
                    } else {
                        alert("Please enter valid values for quantity and unit cost.");
                    }
                },
                getSales(){
                    axios.get('/fetch-sales?type=1')
                        .then(response => {
                            this.sales = response.data['data']
                        })
                        .catch(error => {
                            const err = error.response ? error.response.data : error
                            console.error('Error recording sale:', error.response ? error.response.data : error);
                            alert(err.message);

                        });
                }
            },
            created() {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                if (this.product) {
                    this.profitMargin = this.product['profit_margin'] / 100
                }
                this.getSales();
                console.log('Vue is running!');
            }
        });
    </script>

@endsection
