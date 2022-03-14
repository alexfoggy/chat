import React from 'react';

export default function CheckBox({name, value, tick, onCheck}) {
      return (
          <label>
              <input
              style={{width: 50}}
                  name={name}
                  type="checkbox"
                  value={value}
                  checked={tick || false}
                  onChange={onCheck}
              />
              {value}
          </label>
      );
  }