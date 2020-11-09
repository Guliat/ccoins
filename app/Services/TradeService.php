<?php

namespace App\Services;

class TradeService {

  /**
  * Calculate available money
  * @param $quantity
  * @param $current_price
  * @return - Calculated and formated value.
  */
  function calculateAvailable($quantity, $current_price) {

    return number_format($quantity*$current_price, 2, '.', ' ');

  }

  function calculatePaid($quantity, $open_price) {

    return number_format($quantity*$open_price, 2, '.', ' ');

  }
  
  function calculateProfit($quantity, $current_price, $open_price) {
    
    return number_format((($quantity*$current_price)-($quantity*$open_price)), 2, '.', ' ');

  }
  
}