import React from 'react';
import { Tree, Col, Card, Form, Input, message, Button } from 'antd';
const TreeNode = Tree.TreeNode;
const FormItem = Form.Item;
const Search = Input.Search;

class CategoryTree extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      selectTreeNodeKey: '衣',
      gData: [
        {
          "title": "衣",
          "key": "衣",
          "children": [
            {
              "title": "夏季",
              "key": "夏季",
              "children": [
                {
                  "title": "半袖",
                  "key": "半袖"
                },
                {
                  "title": "短裤",
                  "key": "短裤"
                },
                {
                  "title": "帽子",
                  "key": "帽子"
                }
              ]
            },
            {
              "title": "冬季",
              "key": "冬季",
              "children": [
                {
                  "title": "棉袄",
                  "key": "棉袄"
                },
                {
                  "title": "棉裤",
                  "key": "棉裤"
                },
                {
                  "title": "其他",
                  "key": "其他"
                }
              ]
            },
            {
              "title": "鞋",
              "key": "鞋"
            }
          ]
        },
        {
          "title": "食",
          "key": "食",
          "children": [
            {
              "title": "主食",
              "key": "主食",
              "children": [
                {
                  "title": "早餐",
                  "key": "早餐"
                },
                {
                  "title": "午餐",
                  "key": "午餐"
                },
                {
                  "title": "晚餐",
                  "key": "晚餐"
                }
              ]
            },
            {
              "title": "零食",
              "key": "零食",
              "children": [
                {
                  "title": "其他",
                  "key": "其他"
                },
                {
                  "title": "哈哈",
                  "key": "哈哈"
                },
                {
                  "title": "测试",
                  "key": "测试"
                }
              ]
            },
            {
              "title": "水",
              "key": "水"
            }
          ]
        },
        {
          "title": "其他",
          "key": "其他"
        }
      ]
    }
  }
  onDragEnter = (info) => {
    console.log(info);
    // expandedKeys 需要受控时设置
    // this.setState({
    //   expandedKeys: info.expandedKeys,
    // });
  }
  onDrop = (info) => {
    console.log(info);
    const dropKey = info.node.props.eventKey;
    const dragKey = info.dragNode.props.eventKey;
    const dropPos = info.node.props.pos.split('-');
    const dropPosition = info.dropPosition - Number(dropPos[dropPos.length - 1]);
    // const dragNodesKeys = info.dragNodesKeys;
    const loop = (data, key, callback) => {
      data.forEach((item, index, arr) => {
        if (item.key === key) {
          return callback(item, index, arr);
        }
        if (item.children) {
          return loop(item.children, key, callback);
        }
      });
    };
    const data = [...this.state.gData];
    let dragObj;
    loop(data, dragKey, (item, index, arr) => {
      arr.splice(index, 1);
      dragObj = item;
    });
    if (info.dropToGap) {
      let ar;
      let i;
      loop(data, dropKey, (item, index, arr) => {
        ar = arr;
        i = index;
      });
      if (dropPosition === -1) {
        ar.splice(i, 0, dragObj);
      } else {
        // drag node and drop node in the same level
        // and drop to the last node
        if (dragKey.length === dropKey.length && ar.length - 1 === i) {
          i += 2;
        }
        ar.splice(i - 1, 0, dragObj);
      }
    } else {
      loop(data, dropKey, (item) => {
        item.children = item.children || [];
        // where to insert 示例添加到尾部，可以是随意位置
        item.children.push(dragObj);
      });
    }
    this.setState({
      gData: data,
    });
  }

  handleTreeNodeClick = (key, e) => {
    this.setState({
      selectTreeNodeKey: key[0]
    })
  }

  handleSaveNewCategoryName = (value) => {
    message.error('ERROR: 404 NOT FOUND')
    // for (const variable of this.state.gData) {
    //   console.log(variable)
    // }
    // console.log(this.state.gData.includes(this.state.selectTreeNodeKey))
  }

  loop = data => {
    return data.map((item) => {
      if (item.children && item.children.length) {
        return <TreeNode key={item.key} title={item.title} >{this.loop(item.children)}</TreeNode>;
      }
      return <TreeNode key={item.key} title={item.title} />;
    });
  }

  render() {
    // const { getFieldDecorator } = this.props.form;
    const formItemLayout = {
      labelCol: { span: 24 },
      wrapperCol: { span: 24 },
    };

    return (
      <div>
        <Col span={12}>
          <Card>
            <Search style={{ marginBottom: 8 }} placeholder="搜索" onChange={this.onChange} />
            <Tree
              onSelect={this.handleTreeNodeClick}
              className="draggable-tree"
              defaultExpandAll
              draggable
              onDragEnter={this.onDragEnter}
              onDrop={this.onDrop}
              showSearch
            >
              {this.loop(this.state.gData)}
            </Tree>
          </Card>
        </Col>
        <Col span={10} push={1}>
          <Card>
            <span style={{ fontSize: 20 }}>修改类别名</span>
            <p style={{ marginTop: 18 }}>原名称：{this.state.selectTreeNodeKey}</p>
            <p>修改后名称：</p><Search enterButton="保存" size="large" onSearch={this.handleSaveNewCategoryName} />
            <Button style={{ width: '100%', marginTop: 8 }}>删除类别 {this.state.selectTreeNodeKey} 及其所有子类别</Button>
            <Button style={{ width: '100%', marginTop: 8 }}>新增类别</Button>
          </Card>
        </Col>
      </div >
    );
  }
}

export default Form.create()(CategoryTree);
