import React from 'react'
import { Select } from 'antd';
import 'antd/dist/antd.css';
import { Controller } from "react-hook-form";

export default function SelectOption(props) {
  // console.log(props.main_Language)
  return (
    <div>
      <>
        <Controller
          control={props.control}
          name={props.name}
          as={
            <Select
            defaultValue={props.main_Language}
              showSearch
              style={{ width: '100%' }}
              placeholder={props.main_Language}
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
