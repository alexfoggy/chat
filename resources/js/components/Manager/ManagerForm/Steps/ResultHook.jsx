import React from 'react'
import { useData } from "../DataContainer";
import { useForm } from 'react-hook-form'
import Result from './Result';
import StepContainer3 from './StepsContainer3'


export default function ResultHook(props) {
    console.log(props.projects)
    const { setValues, data } = useData([]);
    const { control } = useForm({
        defaultValues: {
            title: data.title,
            language: data.language,
            country: data.country,
            apply_deadline: data.apply_deadline,
            complete_deadline: data.complete_deadline,
            subject: data.subject,
            type: data.type,
            minutes_per_tasks:data.minutes_per_tasks,
            tasks_per_speaker: data.tasks_per_speaker,
            speakers: data.speakers,
            script: data.script,
            rules: data.rules,
            user_id: data.user_id,
            users: data.users,
            name: data.name
        }
    });
    console.log(data.minutes_per_tasks)
    // console.log(data.tasks_per_speaker)
    return (
        <div>
            
            <Result user={props.user} />
            <StepContainer3  projects={props.projects}  country={data.country}  language={data.language} name={'users'} control={control} />


        </div>
    )
}
