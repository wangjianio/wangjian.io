import React, { Component } from 'react';
import { Calendar, Badge } from 'antd';
import './MoneyIndex.less';
// import AccountInfo from '../../../components/Money/Transaction';

class MoneyIndex extends Component {

  getListData = (value) => {
    let listData;
    switch (value.date()) {
      case 3:
        listData = [
          { type: 'warning', content: '早餐 -8' },
          { type: 'success', content: '理财 +0.13' },
        ]; break;
      case 8:
        listData = [
          { type: 'warning', content: '零食 -10' },
          { type: 'success', content: '理财 +0.25' },
        ]; break;
      case 10:
        listData = [
          { type: 'warning', content: '文具 -18' },
          { type: 'success', content: '理财 +0.08' },
        ]; break;
      case 11:
        listData = [
          { type: 'warning', content: '午饭 -12' },
          { type: 'success', content: '工资 +2000' },
          { type: 'error', content: '王某 -200' },
        ]; break;
      case 15:
        listData = [
          { type: 'warning', content: '水 -3' },
          { type: 'success', content: '奖学金 +200' },
          { type: 'warning', content: '雪糕 -2' },
          { type: 'warning', content: '聚餐 -70' },
        ]; break;
      default:
    }
    return listData || [];
  }

  dateCellRender = (value) => {
    const listData = this.getListData(value);
    return (
      <ul className="events">
        {
          listData.map(item => (
            <li key={item.content}>
              <Badge status={item.type} text={item.content} />
            </li>
          ))
        }
      </ul>
    );
  }

  getMonthData = (value) => {
    return value.month()
  }

  monthCellRender = (value) => {
    const num = this.getMonthData(value);
    return num === 8 ? (
      <div className="notes-month">
        <span>+ 3409.96 元</span><br />
        <span>- 2434.30 元</span>
      </div>
    ) : num === 9 ? (
      <div className="notes-month">
        <span>+ 2789.33 元</span><br />
        <span>- 2345.49 元</span>
      </div>
    ) : num === 10 ? (
      <div className="notes-month">
        <span>+ 0.00 元</span><br />
        <span>- 0.00 元</span>
      </div>
    ) : null
  }

  render() {
    return (
      <div className="money-index">
        <Calendar dateCellRender={this.dateCellRender} monthCellRender={this.monthCellRender} />
      </div>
    )
  }
}

export default MoneyIndex;
