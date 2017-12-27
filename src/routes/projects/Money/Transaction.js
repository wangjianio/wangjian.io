import React, { Component } from 'react';
import TransactionTable from '../../../components/Money/TransactionTable';

class Transaction extends Component {
  render() {
    return (
      <div className="money-transaction">
        <TransactionTable />
      </div>
    )
  }
}

export default Transaction;
