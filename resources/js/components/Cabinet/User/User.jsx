import React from 'react'

const styles = {
    user: {
        display: 'flex',
        alignItems: 'center',
        marginTop: '200px'
    },
    h3: {
        margin: 0
    }

}

class User extends React.Component {
    render() {
        return (
            <div style={styles.user} className='user_controls'>
                <div className='user_logo'>
                    <img src="https://api.adorable.io/avatars/285/g@adorable.io.png" alt=""/>
                </div>
                <div className='user_description'>
                    <h3 style={styles.h3}>{this.props.user.first_name + ' ' + this.props.user.last_name}</h3>
                    <p style={styles.h3}>{this.props.user.email}</p>
                    <a href="#">Logout</a>
                </div>
            </div>
        )
    }
}

export default User
