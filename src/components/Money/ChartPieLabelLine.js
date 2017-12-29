import React, { Component } from 'react';
import { Chart, Axis, Geom, Tooltip, Coord, Legend, Label } from 'bizcharts';
import { DataView } from '@antv/data-set';



class ChartPieLabelLine extends Component {

  render() {

    let data;
    if (this.props.type === 'out') {
      data = [
        { item: '衣', count: 40 },
        { item: '食', count: 21 },
        { item: '住', count: 17 },
        { item: '行', count: 13 },
        { item: '其他', count: 9 }
      ];
    } else if (this.props.type === 'in') {
      data = [
        { item: '零花钱', count: 300 },
        { item: '理财', count: 20 },
        { item: '工资', count: 400 },
        { item: '商业收入', count: 200 },
        { item: '其他收入', count: 50 },
      ];
    }

    const dv = new DataView();
    dv.source(data).transform({
      type: 'percent',
      field: 'count',
      dimension: 'item',
      as: 'percent'
    });
    const cols = {
      percent: {
        formatter: val => {
          val = (val * 100) + '%';
          return val;
        }
      }
    }
    return (
      <Chart height={600} data={dv} scale={cols}  >
        <Coord type='theta' radius={0.75} />
        <Axis name="percent" />
        <Legend position='right' offsetY={-window.innerHeight / 2 + 120} offsetX={-100} />
        <Tooltip
          showTitle={false}
          itemTpl='<li><span style="background-color:{color};" class="g2-tooltip-marker"></span>{name}: {value}</li>'
        />
        <Geom
          type="intervalStack"
          position="percent"
          color='item'
          tooltip={['item*percent', (item, percent) => {
            percent = percent * 100 + '%';
            return {
              name: item,
              value: percent
            };
          }]}
          style={{ lineWidth: 1, stroke: '#fff' }}
        >
          <Label content='percent' formatter={(val, item) => {
            return item.point.item + ': ' + parseFloat(val.replace(/%/, '')).toFixed(2) + '%'
          }} />
        </Geom>
      </Chart>
    )
  }
}

export default ChartPieLabelLine;
