import React from 'react';
import Checkbox from '@material-ui/core/Checkbox';


export default function CheckBox({ name, value, tick, onCheck }) {

    return (
        <label style={{cursor:'pointer', display: 'block'}}>
            <Checkbox
                name={name}
                checked={tick || false}
                onChange={onCheck}
                inputProps={{ 'aria-label': 'primary checkbox' }}
            />
            {/* <input
                name={name}
                type="checkbox"
                value={value}
                checked={tick || false}
                onChange={onCheck}
            /> */}
            {value}
        </label>
    );
}