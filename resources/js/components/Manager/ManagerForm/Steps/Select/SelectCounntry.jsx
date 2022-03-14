import React from 'react'
import { Select } from 'antd';
import 'antd/dist/antd.css';
import { Controller } from "react-hook-form";

export default function SelectCountry(props) {
  return (
    <div>
      <>
        <Controller
          control={props.control}
          name={props.name}
          as={
            <Select
              showSearch
              style={{ width: '100%' }}
              placeholder='languages'
            >
              {props.languages.map((item, idx) => (
                <Select.Option key={idx} value={item.name}>
                  {item.name}
                </Select.Option>
              ))}
            </Select>
          }
        />
      </>
    </div>
  )
}
