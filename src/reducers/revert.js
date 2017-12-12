const revert = (state = true, action) => {
  switch (action.type) {
    case 'REVERT':
      console.log('reducer,revert', action)
      console.log('reducer,return', !action.payload)
      return !action.payload;

    default:
      return state;
  }
}

export default revert;
