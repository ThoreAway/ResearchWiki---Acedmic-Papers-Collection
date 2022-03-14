import React from 'react';

/**
 * A login form that accepts a username and password and features a login button to handle the login
 * 
 * The username and password are both accepted through input boxes and handle their values on change. The login button calls 
 * handleLoginClick when clicked.
 *
 * @author Jacob Clark w18003237
*/

class Login extends React.Component {

render() {
  return (
    <div>
       <input
         type='text' 
         placeholder='username'
         value={this.props.username}
         onChange={this.props.handleUsername}
       />
       <input
         type='password' 
         placeholder='password'
         value={this.props.password}
         onChange={this.props.handlePassword}
       />
      <button onClick={this.props.handleLoginClick}>Log in</button>
    </div>
  );
}
}

export default Login;