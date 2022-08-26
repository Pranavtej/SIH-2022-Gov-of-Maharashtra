<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="styles/kendo.common.min.css" />
    <link rel="stylesheet" href="styles/kendo.default.min.css" />
    <link rel="stylesheet" href="styles/kendo.default.mobile.min.css" />

    <script src="js/jquery.min.js"></script>
    
    
    <script src="js/kendo.all.min.js"></script>
    
    

</head>
<body>
    
			<div class="k-d-flex k-justify-content-center" style="padding-top: 54px;">
				<div class="k-w-300">
					<label for="categories">Categories:</label>
					<input id="categories" />
					</br>
					</br>
					</br>

					<label for="products">Products:</label>
					<input id="products" disabled="disabled" />
					</br>
					</br>
					</br>

					<label for="orders">Orders</label>
					<input id="orders" disabled="disabled" />

					<button class="k-button k-button-solid-primary k-button-solid k-button-md k-rounded-md" id="get" style="margin-top: 2em; float: right;">View Order</button>
				</div>
			</div>

            <style>
                .k-readonly
                {
                    color: gray;
                }
            </style>

            <script>
                $(document).ready(function() {
                    var categories = $("#categories").kendoDropDownList({
                        optionLabel: "Select category...",
                        dataTextField: "CategoryName",
                        dataValueField: "CategoryID",
                        dataSource: {
                            type: "odata",
                            serverFiltering: true,
                            transport: {
                                read: "https://demos.telerik.com/kendo-ui/service/Northwind.svc/Categories"
                            }
                        }
                    }).data("kendoDropDownList");

                    var products = $("#products").kendoDropDownList({
                        autoBind: false,
                        cascadeFrom: "categories",
                        optionLabel: "Select product...",
                        dataTextField: "ProductName",
                        dataValueField: "ProductID",
                        dataSource: {
                            type: "odata",
                            serverFiltering: true,
                            transport: {
                                read: "https://demos.telerik.com/kendo-ui/service/Northwind.svc/Products"
                            }
                        }
                    }).data("kendoDropDownList");

                    var orders = $("#orders").kendoDropDownList({
                        autoBind: false,
                        cascadeFrom: "products",
                        optionLabel: "Select order...",
                        dataTextField: "Order.ShipCity",
                        dataValueField: "OrderID",
                        dataSource: {
                            type: "odata",
                            serverFiltering: true,
                            transport: {
                                read: "https://demos.telerik.com/kendo-ui/service/Northwind.svc/Order_Details?$expand=Order"
                            }
                        }
                    }).data("kendoDropDownList");

                    $("#get").click(function() {
                        var categoryInfo = "\nCategory: { id: " + categories.value() + ", name: " + categories.text() + " }",
                            productInfo = "\nProduct: { id: " + products.value() + ", name: " + products.text() + " }",
                            orderInfo = "\nOrder: { id: " + orders.value() + ", name: " + orders.text() + " }";

                        alert("Order details:\n" + categoryInfo + productInfo + orderInfo);
                    });
                });
            </script>



</body>
</html>