import { connect } from 'react-redux';
import Counter from '../components/Counter';
import { revertBoolean } from '../actions/index';

const mapStateToProps = (state, ownProps) => ({
  value: state.revert
})

const mapDispatchToProps = {
  onBtnClick: revertBoolean
}

const Container = connect(
  mapStateToProps,
  mapDispatchToProps
)(Counter)

export default Container;

