import React, { Component } from 'react';
import AccountInfo from '../../../components/Money/AccountInfo';
import './Account.less';

class Account extends Component {
  render() {
    return (
      <div className="money-account">
        <AccountInfo accountType={0} />
        <AccountInfo accountType={1} />
        <AccountInfo accountType={2} />
        <AccountInfo accountType={3} />
      </div>
    )
  }
}

export default Account;
