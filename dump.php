this.$swal({
                title: "Do you need receipt?",
                showCancelButton: true,
                confirmButtonText: "YES",
                cancelButtonText: "NO"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.orderData.needReceipt = 1
                }



            })











            $user->products()->detach();
        $latest_order = Order::latest()->where('user_id', '=', 1)->get();
        $latest_order_id = $latest_order[0]->id;
        if ($request->needReceipt == 1) {
            // $url = '/receipt/' . $latest_order_id;
            // return Inertia::location($url);

            return Inertia::render(
                'Receipt',
                ['latest_order_id' => $latest_order_id]
            );
        }