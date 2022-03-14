import React, { useState } from "react";

// Components
import { EditorState, convertToRaw } from "draft-js";
import { Editor } from "react-draft-wysiwyg";
import draftToHtml from "draftjs-to-html";

import "react-draft-wysiwyg/dist/react-draft-wysiwyg.css";
import "./Editor.css";

const ReactEditor = props => {
  const [editorState, setEditorState] = useState(EditorState.createEmpty());
  const onEditorStateChange = editorState => {
    setEditorState(editorState);
    return props.onChange(
      draftToHtml(convertToRaw(editorState.getCurrentContent()))
    );
  };

  return (
    <React.Fragment>
      <div className="editor">
        <Editor
        className="editor_heighr"
        toolbar={{
            inline: { inDropdown: true },
            list: { inDropdown: true },
            textAlign: { inDropdown: true },
            link: { inDropdown: false },
            history: { inDropdown: true },
          }}
          editorState={editorState}
          wrapperClassName="wrapper-class"
          editorClassName="editor-class"
          onEditorStateChange={onEditorStateChange}
        />
      </div>
    </React.Fragment>
  );
};

export default ReactEditor;