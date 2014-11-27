div class="tab-pane" id="StockStatus">
                <table id="stock_table">
                    <thead>
                        <th>County</th>
                        <th>Subcounty</th>
                        <th>Facility Name</th>
                        <th>Commodity</th>
                        <th>Beginning Balance</th>
                        <th>Received Qty</th>
                        <th>Used Qty</th>
                        <th>Tests Done</th>
                        <th>Closing Balance</th>
                        <th>Requested Qty</th>
                        <th>Out of Stock days</th>
                        <th>Expiring Qty</th>
                        <th>Allocated Qty</th>
                    </thead>
                    <tbody>
                        <?php 
                        $count = count($stock_status);
                        for ($i=0; $i<$count; $i++){
                            foreach ($stock_status as $key => $value) { ?>
                            <tr>
                                <td><?php echo $value['county']; ?></td>
                                <td><?php echo $value['district']; ?></td>
                                <td><?php echo $value['facility_name']; ?></td>
                                <td><?php echo $value['commodity_name']; ?></td>
                                <td><?php echo $value['sum_opening']; ?></td>
                                <td><?php echo $value['sum_received']; ?></td>
                                <td><?php echo $value['sum_used']; ?></td>
                                <td><?php echo $value['sum_tests']; ?></td>
                                <td><?php echo $value['sum_closing_bal']; ?></td>
                                <td><?php echo $value['sum_requested']; ?></td>
                                <td><?php echo $value['sum_days']; ?></td>
                                <td><?php echo $value['sum_expiring']; ?></td>
                                <td><?php echo $value['sum_allocated']; ?></td>
                            </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane" id="CountyProgess">
                    <p>Howdy, I'm in Section 2.</p>
                </div>