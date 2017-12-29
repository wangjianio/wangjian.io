import React, { Component } from 'react';
import { Chart, Axis, Geom, Tooltip, Legend } from 'bizcharts';
import { DataSet } from '@antv/data-set';

class ChartBarGroupedColumn extends Component {

  render() {

    const data = [
      { name: '支出', '五月': 1817.8, '六月': 2382, '七月': 2133.6, '八月': 4144, '九月': 4704.3, '十月': 3503, '十一月': 3424, '十二月': 3560 },
      { name: '收入', '五月': 1243.3, '六月': 2324.6, '七月': 2453.1, '八月': 3447, '九月': 3451.4, '十月': 2555, '十一月': 1742, '十二月': 4247 }
    ];
    const ds = new DataSet();
    const dv = ds.createView().source(data);
    dv.transform({
      type: 'fold',
      fields: ['五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'], // 展开字段集
      key: '月份', // key字段
      value: '金额', // value字段
    });

    return (
      <div style={{ marginTop: 40 }}>
        <Chart height={400} data={dv} forceFit>
          <Axis name="月份" />
          <Axis name="金额" />
          <Legend />
          <Tooltip crosshairs={{ type: "y" }} />
          <Geom type='interval' position="月份*金额" color={'name'} adjust={[{ type: 'dodge', marginRatio: 1 / 32 }]} />
        </Chart>
      </div>
    )
  }
}

export default ChartBarGroupedColumn;
