import React from 'react';

/**
 * A logout button that calls handleLogoutClick when clicked
 * 
 * @author Jacob Clark w18003237
*/

class Logout extends React.Component {

render() {
  return (
    <div>
      <button onClick={this.props.handleLogoutClick}>Log out</button>
    </div>
  );
}
}

export default Logout;