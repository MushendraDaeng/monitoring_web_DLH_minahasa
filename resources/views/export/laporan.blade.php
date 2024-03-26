  <table style="border: 1px solid;">
                       <thead>
                           <tr>
                                <th>No</th>
                                <th>Pelanggan</th>
                                <th>Total Payment</th>
                                <th>Tanggal Pembayaran</th>
                               
                           </tr>
                       </thead>
                       
                       <tbody>
                           <?php
                           $no = 0;
                           ?>
                           
                            @forelse ($subscriptionReport as $item)
                              <tr style="color: black">
                                  <td>{{ $loop->iteration}}</td>
                                  <td>{{ $item->customer_name }}</td>
                                  <td>{{ $item->total_payment }}</td>
                                  <td>{{ $item->payment_date }}</td>
                                  
                              </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center">
                                        <strong> 
                                            Tidak ada data
                                        </strong>
                                    </td>
                                </tr>
                            @endforelse
                           
                       </tbody>
                   </table>

              